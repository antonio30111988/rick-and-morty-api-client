<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Locations;

use Illuminate\Support\Collection;
use RickAndMortyApiClient\Contracts\Api\RickAndMorty\Locations\LocationProvider;
use RickAndMortyApiClient\Services\Api\Api;
use RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException;
use RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException;
use RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException;
use RickAndMortyApiClient\Services\Api\RickAndMorty\CrudMethods;

class LocationService extends Api implements LocationProvider
{
    use CrudMethods;

    private const REQUEST_URL_V1 = '/api/location';

    /**
     * @var string
     */
    protected $model = Location::class;
    /**
     * @var string
     */
    private $basePath = self::REQUEST_URL_V1;

    /**
     * @param array $data
     * @return Collection
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     * @throws \RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException
     */
    public function getLocationByDimension(array $data): Collection
    {
        $this->validateFiltersForModel($data);
        $queryString = $this->getQueryString($data);
        $this->setRequest(self::REQUEST_URL_V1 . $queryString);
        $this->setHeaders([]);

        return $this->buildFromArray($this->get()->results, Location::class);
    }
}
