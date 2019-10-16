<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Locations;

use RickAndMortyApiClient\RickAndMorty\Services\Api\Filtering\ApiFilterableService;
use RickAndMortyApiClient\Contracts\Api\ApiModel;
use RickAndMortyApiClient\Services\Api\ApiModelTrait;
use RickAndMortyApiClient\Services\Api\RickAndMorty\Characters\Character;

class Location extends ApiFilterableService implements ApiModel
{
    use ApiModelTrait;

    public const ENTITY_NAME = 'location';

    public const FILTERABLE_ATTRIBUTES  = [
        'name',
        'type',
        'dimension'
    ];

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
    private $type;
    /**
     * @var string
     */
    private $dimension;
    /**
     * @var array
     */
    private $residents;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDimension(): string
    {
        return $this->dimension;
    }

    /**
     * @param string $dimension
     */
    public function setDimension(string $dimension): void
    {
        $this->dimension = $dimension;
    }

    /**
     * @return array
     */
    public function getResidents(): array
    {
        return $this->residents;
    }

    /**
     * @param array $residents
     */
    public function setResidents(array $residents): void
    {
        $this->residents = $residents;
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

    /**
     * @return array
     */
    public function getCharacterIds(): array
    {
        return $this->extractIdsFromModelLink($this->getResidents(), Character::ENTITY_NAME);
    }
}