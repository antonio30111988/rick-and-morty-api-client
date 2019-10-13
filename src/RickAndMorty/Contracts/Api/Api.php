<?php

namespace RickAndMortyApiClient\Contracts\Api;

use GuzzleHttp\Client;

interface Api
{
    /**
     * @param array $headers
     *
     * @return void
     */
    public function setHeaders(array $headers = []): void;

    /**
     * @param bool $jsonDecode
     *
     * @return void
     */
    public function setJsonDecode(bool $jsonDecode): void;

    /**
     * @param Client $client
     *
     * @return void
     */
    public function setClient(Client $client): void;

    /**
     * @param $settings
     *
     * @return void
     */
    public function setSettings(array $settings): void;

    /**
     * @param $request
     *
     * @return void
     */
    public function setRequest(string $request): void;

    /**
     * Do a get request to an url
     *
     *
     * @return mixed|null
     */
    public function get();

    /**
     * Do a put request to an url with given input array
     *
     * @param      $data
     *
     * @return mixed|null
     */
    public function put(array $data);

    /**
     * Do a post request to an url with given input array
     *
     * @param      $data
     *
     * @return mixed|null
     */
    public function post(array $data);

    /**
     * Do a delete request to an url with given input array
     *
     * @return mixed|null
     */
    public function delete();
}
