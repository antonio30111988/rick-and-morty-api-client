<?php declare(strict_types=1);

namespace RickAndMortyApiClient\Services\Api;

use Carbon\Carbon;
use RickAndMortyApiClient\Contracts\Api\ApiModel;
use stdClass;

trait ApiModelTrait
{
    /**
     * AbstractApiModel constructor.
     *
     * @param stdClass|null $data
     */
    public function __construct(?stdClass $data)
    {
        if ($data !== null) {
            $this->setFromJson($data);
        }
    }

    /**
     * @param stdClass $data
     */
    final public function setFromJson(stdClass $data): void
    {
        unset($data->className);
        foreach ($data as $key => $val) {
            if (property_exists(__CLASS__, $key)) {
                $functionName = 'set' . ucfirst($key);
                if (is_object($val) && isset($val->className)) {
                    $val = new $val->className($val);
                }
                if (is_array($val)) {
                    $items = [];
                    foreach ($val as $item) {
                        if (is_object($item) && isset($item->className)) {
                            $items[] = new $item->className($item);
                        } else {
                            $items[] = $item;
                        }
                    }
                    $val = $items;
                }
                $this->{$functionName}($val);
            }
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        $asArray = get_object_vars($this);
        $asArray['className'] = self::class;
        return $asArray;
    }

    /**
     * @param int $options
     *
     * @return string
     */
    final public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @param $date
     *
     * @return Carbon
     */
    private function makeDate($date): ?Carbon
    {
        if ($date instanceof Carbon) {
            return $date;
        } elseif (isset($date->date)) {
            return Carbon::make($date->date);
        }
        return Carbon::make($date);
    }

    /**
     * @param array $data
     * @param string $entityName
     * @return array
     */
    private function extractIdsFromModelLink(array $data, string $entityName): array
    {
        return collect($data)->map(function ($item) use ($entityName) {
            return (int)str_replace(config('rick-and-morty-api-client.api.client.base_uri') . '/api/' . $entityName ."/", "", $item);
            //return (int)str_replace("https://rickandmortyapi.com/api/". $entityName ."/", "", $item);
        })->toArray();
    }
}
