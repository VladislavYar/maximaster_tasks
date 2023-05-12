## Описание:
Проект сделан на Laravel. Решения заданий PHP и JS организованы на одном сайте, каждое задание разбито по вкладкам для упрощения навигации.

Как хранилище использовался MySQL, обратите внимание, что в файле ```config/database.php``` отредактированы поля ```charset```, ```collation```, ```engine```,
их значения, по такому же порядку, должны быть ```utf8mb4```, ```utf8mb4_unicode_ci```, ```InnoDB ROW_FORMAT=DYNAMIC```.

В ```routes/web.php``` подписан каждый маршрут к какому заданию он относится. Маршруты с API находятся в ```routes/api.php```.

В ```public/js(css)/app.js(css)``` находится код с решением заданий.

## В файле ```.env``` добавлены новые поля:
   - LOGIN_MAXIMASTER = {логин на Ваш сайт}
   - PASSWORD_MAXIMASTER = {пароль на Ваш сайт}


## Как запустить проект:
   - установить зависимости ```composer install```;
   - создать в корне проекта файл ```.env```, заполнить его данными из ```.env.examle```, отредактировать необходимые поля    
   (Команда для генерации поля APP_KEY ```php artisan key:generate```);
   - Создать MySQL базу, запустить миграции ```php artisan migrate```;
   - запустить проект ```php artisan serve```.


## Что использовалось при выполнении заданий:
 - PHP 8.2.5;
 - Laravel Framework 10.9.0;
 - Bootstrap  v5.3.0-alpha3(CSS);
 - Bootstrap v5.0.2(JS);
 - Chart.js v4.3.0;
 - jQuery v3.6.4;
 - jQuery Validation Plugin - v1.19.2;
 - JSAPI 2.1.
