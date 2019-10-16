<?php

namespace RickAndMortyApiClient\RickAndMorty\Contracts\Api\Filtering;

use RickAndMortyApiClient\Services\Api\Exception\FilterNotAvailableException;

interface ApiFilterableProvider
{
    /**
     * Git filterable attributes
     * @return array|null
     */
    public function getFilters(): ?array;

    /**
     * Git filterable attributes
     *
     * @param array $filters
     */
    public function setFilters(?array $filters = null): void;

    /**
     * Validate if provided filters are applicable
     *
     * @param array $attributes
     * @throws FilterNotAvailableException
     */
    public function validateFilters(array $attributes): void;
}