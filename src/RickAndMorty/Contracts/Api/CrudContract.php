<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Contracts\Api;

use Illuminate\Support\Collection;

interface CrudContract
{
    /**
     * @param string|null $token
     * @param array  $with
     * @param int    $limit
     * @param string $sort
     *
     * @return Collection
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException
     */
    public function all(?string $token = null, array $with = [], int $limit = 0, string $sort = ''): Collection;

    /**
     * @param string|null $token
     * @param int    $id
     * @param array  $included
     *
     * @return mixed
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException
     */
    public function show(?string $token = null, int $id, array $included = []);

    /**
     * @param string|null $token
     * @param array  $data
     *
     * @return mixed
     */
    public function create(?string $token = null, array $data);

    /**
     * @param string|null $token
     * @param int    $id
     * @param array  $data
     *
     * @return mixed
     */
    public function update(?string $token = null, int $id, array $data);
}
