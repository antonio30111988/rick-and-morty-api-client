<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Characters;

use RickAndMortyApiClient\Contracts\Api\RickAndMorty\Characters\CharacterProvider;
use RickAndMortyApiClient\Services\Api\Api;
use RickAndMortyApiClient\Services\Api\RickAndMorty\CrudMethods;

class CharacterService extends Api implements CharacterProvider
{
    use CrudMethods;

    private const REQUEST_URL_V1 = '/api/character';

    /**
     * @var string
     */
    protected $model = Character::class;
    /**
     * @var string
     */
    private $basePath = self::REQUEST_URL_V1;
}
