# Rick and Morty API Client package

This package is a REST Client for Rick and Morty public API. You can include this package into your any Laravel 
project to use. Please follow the guid below.

## How to include the package to your laravel project
add the following snippet to you composer.json
```json
"require": {
        "t2a/helpers": "dev-master"
    },
"repositories": [
        {
            "type": "git",
            "url":  "https://github.com/antonio30111988/rick-and-morty-api-client.git"
        }
    ]
```

## Publish package config 
Please run the following command in your terminal in your project
```bash
php artisan vendor:publish --provider="RickAndMortyApiClient\RickAndMortyApiClientServiceProvider"
```

