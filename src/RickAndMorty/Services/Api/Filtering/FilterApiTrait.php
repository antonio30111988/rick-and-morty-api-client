<?php declare(strict_types=1);

namespace RickAndMortyApiClient\RickAndMorty\Services\Api\Filtering;

trait FilterApiTrait
{
    /**
     * @param array $filters
     * @return string
     */
    public function buildFilterQueryString(array $filters): string
    {
        return  http_build_query($filters);
    }

    /**
     * @param array $ids
     * @return string
     */
    public function buildMultipleRecordsFilterQueryString(array $ids): string
    {
        return implode(',', $ids);
    }

    /**
     * @param array|null $filterData
     * @return string
     */
    public function getQueryString(?array $filterData = null): string
    {
        $queryString = '';
        if ($filterData) { 
            if (isset($filterData['ids'])) {
                $queryString .= '/' . $this->buildMultipleRecordsFilterQueryString($filterData['ids']);
            } else if (isset($filterData['filters'])) {
                $queryString .= '?' .$this->buildFilterQueryString($filterData['filters']);
            }
            return $queryString;
        }
        return $queryString;
    }

    /**
     * @param array|null $filterData
     * @return array|null
     */
    public function getFilterAttributesFromRequest(?array $filterData = null): ?array
    {
        if (!$filterData) {
            return null;
        }
        if (isset($filterData['filters'])) {
            return array_values($filterData);
        }
        return null;
    }
}