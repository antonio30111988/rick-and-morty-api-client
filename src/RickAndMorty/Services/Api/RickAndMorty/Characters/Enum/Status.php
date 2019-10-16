<?php

namespace RickAndMortyApiClient\RickAndMorty\Services\Api\RickAndMorty\Characters\Enum;

use MyCLabs\Enum\Enum;

class Status extends Enum
{
    private const ALIVE = 'alive';
    private const DEAD = 'dead';
    private const UNKNOWN = 'unknown';
}