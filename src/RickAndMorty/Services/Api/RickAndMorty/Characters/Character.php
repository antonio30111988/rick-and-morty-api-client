<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\RickAndMorty\Characters;

use Carbon\Carbon;
use stdClass;
use RickAndMortyApiClient\Contracts\Api\ApiModel;
use RickAndMortyApiClient\Services\Api\ApiModelTrait;

class Character implements ApiModel
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
    private $status;
    /**
     * @var string
     */
    private $species;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $gender;
    /**
     * @var \stdClass
     */
    private $origin;
    /**
     * @var \stdClass
     */
    private $location;
    /**
     * @var string
     */
    private $image;
    /**
     * @var array
     */
    private $episode;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSpecies(): string
    {
        return $this->species;
    }

    /**
     * @param string $species
     */
    public function setSpecies(string $species): void
    {
        $this->species = $species;
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
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return stdClass
     */
    public function getOrigin(): stdClass
    {
        return $this->origin;
    }

    /**
     * @param stdClass $origin
     */
    public function setOrigin(stdClass $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return stdClass
     */
    public function getLocation(): stdClass
    {
        return $this->location;
    }

    /**
     * @param stdClass $location
     */
    public function setLocation(stdClass $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getEpisode(): array
    {
        return $this->episode;
    }

    /**
     * @param array $episode
     */
    public function setEpisode(array $episode): void
    {
        $this->episode = $episode;
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