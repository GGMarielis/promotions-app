# Application Setup Guide

## Introduction

This guide is especially designed for users running a Debian-based Linux distribution, such as Ubuntu

## Prerequisites

Ensure you have the following prerequisites installed on your system:

- PHP v8.1 or higher
- Composer v2.2 or higher
- Docker v25
- Docker Compose v2.24 or higher
- PHP extensions:
    - php-curl
    - php-sqlite3
    - php-mysql
    - php-dom
    - php-xml
    - php-intl
    - php-mbstring

**Note:** Ensure that Docker is added to the root group on your system.

### Running the Application

Add permission to run the following script

```shell
chmod +x start_app.sh
```

To start the application at first time, execute the following command in your terminal:

```shell
./start_app.sh
```

### Documentation

You can access the documentation for all the endpoints at the following URL: [Documentation](http://localhost:8000/api/documentation)

You can access to the scripts for population on [SQL scripts](./database/sql/population.sql)


### Additional Commands

For functionalities as *ASCII searcher* and *prime numbers* also you can use commands

```shell ASCII searcher
php artisan app:ascii-searcher
```

```shell Prime numbers
php artisan  app:prime-numbers 
```
