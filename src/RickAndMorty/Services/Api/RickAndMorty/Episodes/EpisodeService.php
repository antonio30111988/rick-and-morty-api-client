<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Episodes;

use RickAndMortyApiClient\Contracts\Api\RickAndMorty\Episodes\EpisodeProvider;
use RickAndMortyApiClient\Services\Api\Api;
use RickAndMortyApiClient\Services\Api\RickAndMorty\CrudMethods;

class EpisodeService extends Api implements EpisodeProvider
{
    use CrudMethods;

    private const REQUEST_URL_V1 = '/api/episode';

    /**
     * @var string
     */
    protected $model = Episode::class;
    /**
     * @var string
     */
    private $basePath = self::REQUEST_URL_V1;
}
