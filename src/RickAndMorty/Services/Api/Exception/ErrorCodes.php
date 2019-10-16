<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\Exception;

class ErrorCodes
{
    public const ROUTE_NOT_FOUND = 30;
    public const ROUTE_NOT_FOUND_KEY = 'noRouteFound';

    public const UNKNOWN_ERROR = 11;
    public const VALIDATION_ERROR = 9998;
}
