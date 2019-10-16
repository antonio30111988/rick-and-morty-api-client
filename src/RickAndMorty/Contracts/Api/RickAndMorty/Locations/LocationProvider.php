<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Contracts\Api\RickAndMorty\Locations;

use RickAndMortyApiClient\Contracts\Api\CrudContract;
use Illuminate\Support\Collection;
use RickAndMortyApiClient\Services\Api\RickAndMorty\Locations\Location;
use RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException;
use RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException;
use RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException;

interface LocationProvider extends CrudContract
{
    /**
     * @param array $data
     * @return Collection
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException
     */
    public function getLocationByDimension(array $data): Collection;
}
