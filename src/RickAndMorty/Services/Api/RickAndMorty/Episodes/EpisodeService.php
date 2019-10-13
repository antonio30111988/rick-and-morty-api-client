<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Episodes;

use Illuminate\Support\Collection;
use RickAndMortyApiClient\Contracts\Api\RickAndMorty\Episodes\EpisodeProvider;
use RickAndMortyApiClient\Services\Api\Api;
use RickAndMortyApiClient\Services\Api\Exception\ApiConnectionException;
use RickAndMortyApiClient\Services\Api\Exception\ApiEndpointNotFoundException;
use RickAndMortyApiClient\Services\Api\Exception\ApiInvalidRequestException;
use RickAndMortyApiClient\Services\Api\RickAndMorty\CrudMethods;

class EpisodeService extends Api implements EpisodeProvider
{
    private const REQUEST_URL_V1 = '/v1/episodes';

    /**
     * @var string
     */
    private $model = Episode::class;
    /**
     * @var string
     */
    private $basePath = self::REQUEST_URL_V1;

    use CrudMethods;

    /**
     * @param string $token
     * @param array  $data
     * @param int    $limit
     * @param string $sort
     *
     * @return Collection
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function getBookingsByBookingReferenceNumbers(
        string $token,
        array $data,
        int $limit = 0,
        string $sort = ''
    ): Collection {
        $queryString = '/?limit=' . $limit . '&sort=' . $sort;

        $this->setRequest(self::BOOKINGS_BY_REFERENCE_NUMBERS_V1 . $queryString);
        $this->setHeaders([
            'token' => $token,
        ]);
        return $this->buildFromArray($this->post($data));
    }


    /**
     * @param string $token
     * @param int    $id
     *
     * @return Character
     * @throws ApiConnectionException
     * @throws ApiEndpointNotFoundException
     * @throws ApiInvalidRequestException
     */
    public function getBookingById(string $token, int $id): Character
    {
        $this->setRequest(self::REQUEST_URL_V1 . '/' . $id);
        $this->setHeaders([
            'token' => $token,
        ]);

        return new Character($this->get());
    }
}
