# Reservation Vaccination Backend

## Requirements

- PHP 8.0
- mysql

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone git@github.com:erisitohang/key-value-store.git

Switch to the repo folder

    cd key-value-store

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve


## Docker

To install with [Docker](https://www.docker.com), run following commands:

```
git clone git@github.com:erisitohang/key-value-store.git
cd key-value-store
cp .env.example.docker .env
```
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
```
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```

## Run Test

```
php artisan test
```


## Endpoints:

### Add object:

`POST /object`

Example request body:
```JSON
{
    "mykey": "mykey_value"
}
```

### Add object:

`GET /object/mykey`

Example response:
```JSON
{
    "mykey": "mykey_value"
}
```

### Add object:

`GET /object/get_all_records`

Example response:
```JSON
[
    {
        "mykey": "mykey_value"
    }
]
```

