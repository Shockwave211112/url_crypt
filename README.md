# Links

>Laravel v10.26.2
> 
>PHP 8.1
> 
>Spattie Permissions
>
>L5-Swagger Documentation
>
>Разделение проекта на модули (App -> Modules)
> 
>Унифицированный CRUD репозиторий
> 
>Кэширование GET запросов
> 
>Автозаполнение таблицы прав из контроллеров
> 
>Google & Facebook auth


Docker-контейнеры настроены на локальный запуск по адресу http://localhost:8000

Документация: http://localhost:8000/api/docs

## Неообходимо

* Docker

## Запуск

Скопировать проект в папку, создать .env файл:
```shell
cp .env.example .env
```
Настроить .env файл. Необходимые поля:
* APP_FRONT_URL
* ADMIN_EMAIL
* ADMIN_PWD
* BASIC_USER_EMAIL
* BASIC_USER_PWD
* GOOGLE_CLIENT_ID
* GOOGLE_CLIENT_SECRET
* FACEBOOK_CLIENT_ID
* FACEBOOK_CLIENT_SECRET
* Поля MAIL

Запустить контейнеры:
```shell
docker compose up -d
```

По умолчанию в контейнере php-queue в docker-compose указан entrypoint на следующие команды при запуске:
```shell
composer update

php artisan key:generate

php artisan optimize:clear

php artisan optimize

php artisan migrate:fresh --force

php artisan db:seed --force

php artisan queue:work
```

Для сохранения данных после первого запуска заменить:
```shell
command: [ "./docker/entrypoint.sh" ]
```
На:
```shell
command: php artisan queue:work
```
