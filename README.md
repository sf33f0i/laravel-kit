# laravel-kit

## Quickstart
1. [Install docker](https://docs.docker.com/install/)
2. [Install docker-compose](https://docs.docker.com/compose/install/)
3. [Install traefik](https://github.com/mediaten/traefik)

## Установка
Копировать .env файл (обновить, если требуется)

Установить приложение в Docker
```
make install
make env
```

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
