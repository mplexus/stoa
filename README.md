# Stoa

Demo web application for selling stuff.

## Set up

1. First create the database at your will and point the application to it
by editting .env with db location and db user credentials.

2. Then use doctrine to build the schema automatically by reading the appropriate
annotations in the source code. To do this run the following command.

```php
php vendor/doctrine/orm/bin/doctrine  orm:schema-tool:create
```

3. Load data fixtures in the database. Random data are generated with the following command.

```php
php bin/load-fixtures.php
```

## Run

Simply point your web server to web/index.php or use php's built-in web server:

```php
php -S localhost:8000 -t web
```
