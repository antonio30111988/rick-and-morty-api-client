<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Contracts\Api;

use Illuminate\Support\Collection;

interface CrudContract
{
    /**
     * @param array|null  $filterData
     *
     * @return Collection
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException
     */
    public function all(?array $filterData = null): Collection;

    /**
     * @param int    $id
     * @param array  $filterData
     *
     * @return mixed
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException
     */
    public function show(int $id, ?array $filterData = null);

    /**
     * @param array  $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int    $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update(int $id, array $data);
}
