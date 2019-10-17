<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty;

use Illuminate\Support\Collection;
use RickAndMortyApiClient\RickAndMorty\Services\Api\Filtering\FilterApiTrait;
use RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException;
use RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException;
use RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException;

trait CrudMethods
{
    use FilterApiTrait;

    /**
     * @param array|null $filterData
     * @return Collection
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function all(?array $filterData = null): Collection
    {
        $this->validateFiltersForModel($filterData);
        $queryString = $this->getQueryString($filterData);
        $this->setRequest($this->basePath . $queryString);
        $this->setHeaders([]);

        return $this->buildFromArray(
            (isset($this->get()->results)) ?
                $this->get()->results :
                $this->get()
        );
    }

    /**
     * @param int $id
     * @param array|null $filterData
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function show(int $id, ?array $filterData = null)
    {
        $this->validateFiltersForModel($filterData);
        $queryString = $this->getQueryString($filterData);

        $this->setRequest($this->basePath . '/' . $id . $queryString);
        $this->setHeaders([]);

        if (isset($this->model)) {
            return new $this->model($this->get());
        }
        return $this->get();
    }

    /**
     * @param array       $data
     *
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function create(array $data)
    {
        $this->setRequest($this->basePath);
        $this->setHeaders([]);

        if (isset($this->model)) {
            return new $this->model($this->post($data));
        }
        return $this->post($data);
    }

    /**
     * @param int         $id
     * @param array       $data
     *
     * @return mixed
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function update(int $id, array $data)
    {
        $this->setRequest($this->basePath . '/' . $id);
        $this->setHeaders([]);

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

    /**
     * @param array|null $filters
     */
    private function validateFiltersForModel(?array $filters = null): void
    {
        $attributes = $this->getFilterAttributesFromRequest($filters);
        if ($attributes) {
            $this->getAPIModel()->validateFilters($attributes);
        }
    }
}
