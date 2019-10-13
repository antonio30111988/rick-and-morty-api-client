<?php

namespace RickAndMortyApiClient\Services\Api;

use Exception;
use function json_decode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Validation\ValidationException;
use RickAndMortyApiClient\Contracts\Api\Api as ApiInterface;
use RickAndMortyApiClient\Services\Api\Exception\{
    ApiConnectionException,
    ApiInvalidRequestException,
    ApiEndpointNotFoundException,
    ErrorCodes
};

abstract class Api implements ApiInterface
{
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var bool
     */
    protected $jsonDecode = true;
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var array
     */
    protected $settings;
    /**
     * @var string
     */
    protected $request;

    /**
     * @param Client $client
     *
     * @return void
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @param $settings
     *
     * @return void
     */
    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @param string $request
     *
     * @return void
     */
    public function setRequest(string $request): void
    {
        $this->request = $request;
    }

    /**
     * @param array $headers
     *
     * @return void
     */
    public function setHeaders(array $headers = []): void
    {
        $this->headers = $headers;
    }

    /**
     * @param bool $jsonDecode
     *
     * @return void
     */
    public function setJsonDecode(bool $jsonDecode): void
    {
        $this->jsonDecode = $jsonDecode;
    }

    /**
     * Api constructor.
     *
     * @param Client $client
     * @param array  $settings
     */
    public function __construct(Client $client, array $settings)
    {
        $this->setClient($client);
        $this->setSettings($settings);
    }

    /**
     * Do a get request to an url
     *
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     * @return mixed|null
     */
    public function get()
    {
        try {
            $response = $this->client->get($this->request, $this->defaultParameters());
        } catch (Exception $e) {
            $this->errorHandling($e);
        }

        if (null === $response) {
            return [];
        }

        return $this->getOutput($response);
    }

    /**
     * Do a post request to an url with given input array
     *
     * @param array $data
     *
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     * @return mixed|null
     */
    public function put(array $data)
    {
        try {
            $post = array_merge(['json' => $data], $this->defaultParameters());
            $response = $this->client->put($this->request, $post);
        } catch (Exception $e) {
            $this->errorHandling($e);
        }

        if (null === $response) {
            return [];
        }

        return $this->getOutput($response);
    }

    /**
     * Do a post request to an url with given input array
     *
     * @param array $data
     *
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     * @return mixed|null
     */
    public function post(array $data)
    {
        try {
            $post = array_merge(['json' => $data], $this->defaultParameters());
            $response = $this->client->post($this->request, $post);
        } catch (Exception $e) {
            $this->errorHandling($e);
        }

        if (null === $response) {
            return [];
        }

        return $this->getOutput($response);
    }

    /**
     * Do a delete request to an url with given input array
     *
     * @throws ApiConnectionException
     * @throws ApiInvalidRequestException
     */
    public function delete(): void
    {
        try {
            $this->client->delete($this->request, $this->defaultParameters());
        } catch (Exception $e) {
            $this->errorHandling($e);
        }
    }

    /**
     * Return default parameters
     *
     * @return array
     */
    private function defaultParameters(): array
    {
        $parameters = [];
        $parameters['headers'] = $this->headers;

        return $parameters;
    }

    /**
     * @param $response
     *
     * @throws ApiEndpointNotFoundException
     * @return mixed
     */
    private function getOutput($response)
    {
        if ($this->jsonDecode) {
            $contents = $response->getBody()->getContents();
            if (empty($contents) || $contents === '') {
                throw new ApiEndpointNotFoundException('Not found', 404, null);
            }
            return json_decode($contents);
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param Exception $e
     *
     * @throws ApiConnectionException
     * @throws ApiInvalidRequestException
     */
    private function errorHandling(Exception $e): void
    {
        if ($e instanceof ConnectException) {
            throw new ApiConnectionException(
                'Connection error' . PHP_EOL . $e->getMessage(),
                503,
                null
            );
        }
        if ($e instanceof ClientException) {
            $contents = json_decode($e->getResponse()->getBody()->getContents());

            if ($contents && property_exists($contents, 'error')) {
                if ($contents->error->code === ErrorCodes::VALIDATION_ERROR) {
                    $errors = [];
                    foreach ($contents->error->error_details as $key => $value) {
                        array_shift($value);
                        $errors[$key] = Lang::get('validation.' . $key, $value);
                    }
                    throw ValidationException::withMessages($errors);
                }
                if (array_key_exists($contents->error->code, ErrorCodes::MAP_CODE_TO_KEY)) {
                    $key = ErrorCodes::MAP_CODE_TO_KEY[$contents->error->code];
                    throw ValidationException::withMessages([
                        $key => Lang::get('validation.' . $key)
                    ]);
                }
                if ($contents->error->code !== ErrorCodes::UNKNOWN_ERROR) {
                    throw new ApiInvalidRequestException($contents->error);
                }
            }
        }
        throw $e;
    }
}
