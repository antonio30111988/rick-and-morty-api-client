<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty;

use Illuminate\Support\Collection;
use RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException;
use RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException;
use RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException;

trait CrudMethods
{
    /**
     * @param string|null $token
     * @param array       $with
     * @param int         $limit
     * @param string      $sort
     *
     * @return Collection
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function all(?string $token = null, array $with = [], int $limit = 0, string $sort = ''): Collection
    {
        $queryString = '/?limit=' . $limit . '&sort=' . $sort . ($with ? '&with[]=' . implode(',', $with) : '');

        $this->setRequest($this->basePath . $queryString);
        $this->setHeaders([
            'token' => $token,
        ]);
        return $this->buildFromArray($this->get());
    }

    /**
     * @param string|null $token
     * @param int         $id
     * @param array       $included
     *
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function show(?string $token = null, int $id, array $included = [])
    {
        $queryString = $included ? '?included=' . implode(',', $included) : '';
        $this->setRequest($this->basePath . '/' . $id . $queryString);
        $this->setHeaders([
            'token' => $token,
        ]);
        if (isset($this->model)) {
            return new $this->model($this->get());
        }
        return $this->get();
    }

    /**
     * @param string|null $token
     * @param array       $data
     *
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function create(?string $token = null, array $data)
    {
        $this->setRequest($this->basePath);
        $this->setHeaders([
            'token' => $token,
        ]);

        if (isset($this->model)) {
            return new $this->model($this->post($data));
        }
        return $this->post($data);
    }

    /**
     * @param string|null $token
     * @param int         $id
     * @param array       $data
     *
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function update(?string $token = null, int $id, array $data)
    {
        $this->setRequest($this->basePath . '/' . $id);
        $this->setHeaders([
            'token' => $token,
        ]);

        if (isset($this->model)) {
            return new $this->model($this->put($data));
        }
        return $this->put($data);
    }

    /**
     * @param array       $items
     * @param string|null $modelClass
     *
     * @return Collection
     */
    private function buildFromArray(?array $items, string $modelClass = null): Collection
    {
        if ($items === null) {
            $items = [];
        }
        $model = $modelClass ?? $this->model ?? null;
        if ($model !== null) {
            $models = [];
            foreach ($items as $item) {
                $models[] = new $model($item);
            }
            return collect($models);
        }
        return collect($items);
    }
}
