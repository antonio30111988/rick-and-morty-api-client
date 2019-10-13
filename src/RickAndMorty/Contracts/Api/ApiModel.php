<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Contracts\Api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use stdClass;

interface ApiModel extends Jsonable, Arrayable, JsonSerializable
{
    /**
     * @param stdClass $data
     */
    public function setFromJson(stdClass $data): void;
}
