<?php

namespace RickAndMortyApiClient;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use RickAndMortyApiClient\Contracts;
use RickAndMortyApiClient\RickAndMorty\Contracts\Api\Filtering\ApiFilterableProvider;
use RickAndMortyApiClient\RickAndMorty\Services\Api\Filtering\ApiFilterableService;
use RickAndMortyApiClient\Services;

class RickAndMortyApiClientServiceProvider extends ServiceProvider
{
    private $settings;
    /**
     * @var Client
     */
    private $client;

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/rick-and-morty-api-client.php' => config_path('rick-and-morty-api-client.php'),
        ], 'config');
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfigs();
        $this->registerEndpoints();
    }

    /**
     * Register endpoints
     */
    private function registerEndpoints(): void
    {
        $this->settings = config('rick-and-morty-api-client.api');
        $this->client = new Client($this->settings['client']);

        //Entity Bindings
        $this->bindService(
            Contracts\Api\RickAndMorty\Characters\CharacterProvider::class,
            Services\Api\RickAndMorty\Characters\CharacterService::class
        );
        $this->bindService(
            Contracts\Api\RickAndMorty\Episodes\EpisodeProvider::class,
            Services\Api\RickAndMorty\Episodes\EpisodeService::class
        );
        $this->bindService(
            Contracts\Api\RickAndMorty\Locations\LocationProvider::class,
            Services\Api\RickAndMorty\Locations\LocationService::class
        );

        //Filterable Interface
        $this->bindService(
            ApiFilterableProvider::class,
            ApiFilterableService::class
        );
    }

    /**
     * @param string $interfaceName
     * @param string $className
     */
    private function bindService(string $interfaceName, string $className): void
    {
        $this->app->bind($interfaceName, function () use ($className) {
            return new $className($this->client, $this->settings['settings']);
        });
    }

    /**
     * Register Configs
     */
    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/rick-and-morty-api-client.php',
            'rick-and-morty-api-client'
        );
    }
}
