<?php declare(strict_types=1);

namespace RickAndMortyApiClient\RickAndMorty\Services\Api\Filtering;

use RickAndMortyApiClient\RickAndMorty\Contracts\Api\Filtering\ApiFilterableProvider;
use RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException;

class ApiFilterableService implements ApiFilterableProvider
{
    use FilterApiTrait;

    public const FILTERABLE_ATTRIBUTES  = [];

    /**
     * @var array|null
     */
    private $filters;

    /**
     * @return array|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param array|null $filters
     */
    public function setFilters(?array $filters = null): void
    {
        $this->filters = $filters;
    }

    /**
     * @param array $attributes
     * @throws FilterNotAvailableException
     */
    public function validateFilters(array $attributes): void
    {
        $filters = $this->getFilters();
        if ($filters) {
            foreach ($attributes as $attribute) {
                if (in_array($attribute, $filters)) {
                    throw new FilterNotAvailableException(
                        "This attributes cannot be filtered.",
                        422,
                        null
                    );
                }
            }
        }
    }
}