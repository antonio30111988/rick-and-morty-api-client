<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Episodes;

use Carbon\Carbon;
use stdClass;
use RickAndMortyApiClient\Contracts\Api\ApiModel;
use RickAndMortyApiClient\Services\Api\ApiModelTrait;

class Episode implements ApiModel
{
    use ApiModelTrait;

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $air_date;
    /**
     * @var string
     */
    private $episode;
    /**
     * @var array
     */
    private $characters;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $created;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAirDate(): string
    {
        return $this->air_date;
    }

    /**
     * @param string $air_date
     */
    public function setAirDate(string $air_date): void
    {
        $this->air_date = $air_date;
    }

    /**
     * @return string
     */
    public function getEpisode(): string
    {
        return $this->episode;
    }

    /**
     * @param string $episode
     */
    public function setEpisode(string $episode): void
    {
        $this->episode = $episode;
    }

    /**
     * @return array
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }

    /**
     * @param array $characters
     */
    public function setCharacters(array $characters): void
    {
        $this->characters = $characters;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated(string $created): void
    {
        $this->created = $created;
    }
}