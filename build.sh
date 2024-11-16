#!/bin/sh
set -e

export $(grep -Fe PHP_VERSION -Fe PROJECT_NAME .env | xargs)

docker build \
    -t "${PROJECT_NAME}"/php:"${PHP_VERSION}" \
    -t "${PROJECT_NAME}"/php:latest \
    --build-arg PHP_BASE_IMAGE_VERSION="${PHP_VERSION}" \
    ./docker/php/

docker build \
    -t "${PROJECT_NAME}"-cron/php:"${PHP_VERSION}" \
    -t "${PROJECT_NAME}"-cron/php:latest \
    --build-arg PHP_BASE_IMAGE_VERSION="${PHP_VERSION}" \
    --build-arg PROJECT_NAME="${PROJECT_NAME}" \
    ./docker/php-cron/
