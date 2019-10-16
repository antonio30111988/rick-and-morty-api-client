<?php

namespace RickAndMortyApiClient\RickAndMorty\Services\Api\RickAndMorty\Characters\Enum;

use MyCLabs\Enum\Enum;

class Gender extends Enum
{
    private const FEMALE = 'female';
    private const MALE = 'male';
    private const GENDERLESS = 'genderless';
    private const UNKNOWN = 'unknown';
}