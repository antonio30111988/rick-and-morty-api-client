<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api\Exception;

use Exception;
use stdClass;

class ApiInvalidRequestException extends Exception
{
    /**
     * ApiInvalidRequestException constructor.
     *
     * @param stdClass $error
     */
    public function __construct(stdClass $error)
    {
        parent::__construct($error->message, $error->code);
    }
}
