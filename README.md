# Тестовое задание gecode-test

## Quickstart
1. [Install docker](https://docs.docker.com/install/)
2. [Install docker-compose](https://docs.docker.com/compose/install/)
3. [Install traefik](https://github.com/mediaten/traefik)

## Установка
Копировать .env файл (обновить, если требуется)

| Переменная               | Описание                                                   |
|--------------------------|------------------------------------------------------------|
| DOCKER_DOMAIN            | URL приложения                                             |
| PROJECT_NAME             | Наименование проекта                                       |
| APP_DEBUG                | Дебаг режим (true/false)                                   |
| COMPOSE_FILE             | Используемый docker-compose файл                           |
| DB_DATABASE              | Имя БД                                                     |
| DB_USERNAME              | Пользователь БД                                            |
| DB_PASSWORD              | Пароль от БД                                               |
| RESTART                  | Политика перезапуска (no/on-failure/always/unless-stopped) |
| DOCKER_DB_PORT           | Внешний порт базы данных                                   |
| APP_ENV                  | Текущая среда приложения(development/testing/local/prod)   |
| PHP_USER_ID              | ID пользователя от которого будет работать PHP             |
| YANDEX_GEOCODER_API_KEY  | Ключ API для Yandex Geocoder                               |



Установить приложение в Docker
```
make install
make env
```
Для корректной работы необходимо добавить в файл .env значение для переменной окружения YANDEX_GEOCODER_API_KEY.

## Использование

Для подключения к рабочему окружению
```
make env
```

Установка **composer**
```
make composer-install
```

Выполнение команд **composer**
```
make composer-command command="require \"packege/packege\":\"dev-master\""
```

Установка миграций
```
make migrate
```

Установка сидов
```
make artisan-seed
```

Создание symlink public storage
```
make artisan-storage-link
```

Генерация _ide-helper.php
```
make generate-ide-helper
```

Выполнение **artisan** команд
```
make artisan-cmd cmd="command"
```

## Yarn

Установка пакетов из `yarn.lock`
```
make yarn-install
```

Добавление пакета в `package.json`
```
make yarn-command command="add package:0.1"
```

Сборка в dev режиме
```
make yarn-dev
# or
make yarn-watch
```

Сборка в prod режиме
```
make yarn-prod
```
