#!/bin/bash

echo "Starting to install all dependencies..."
composer install

echo "Copy .env.example on .env"
cp .env.example .env

echo "Starting services with Docker Compose..."
docker compose up -d

if [ $? -eq 0 ]; then
    echo "Docker Compose started successfully."
else
    echo "Error starting Docker Compose. Check the logs for more details."
    exit 1
fi

echo "Starting running migrations"
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed


echo "Starting the built-in PHP server on localhost:8000..."
php artisan serve
