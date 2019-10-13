<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Contracts\Api\RickAndMorty\Locations;

use Illuminate\Support\Collection;
use RickAndMortyApiClient\Services\Api\RickAndMorty\Characters\Character;
use RickAndMortyApiClient\Contracts\Api\CrudContract;

interface LocationProvider extends CrudContract
{
    /**
     * @param string $token
     * @param array  $data
     * @param int    $limit
     * @param string $sort
     *
     * @return Collection
     */
    public function getBookingsByBookingReferenceNumbers(
        string $token,
        array $data,
        int $limit = 0,
        string $sort = ''
    ): Collection;

    /**
     * @param string $token
     * @param int    $id
     *
     * @return Character
     */
    public function getBookingById(string $token, int $id): Character;
}
