User accounts
=========================

Минимальные требования:

php 7.0+

mysql 5.7+

Установка - клонировать репозиторий и запустить

``` composer install ```

Папка index файла /web/index.php

После установки прописать конфиг к БД в файле /config/db.php
``` 
     'dsn' => 'mysql:host=localhost;dbname=user_account',
     'username' => 'root',
     'password' => '',
     'charset' => 'utf8',
     'tablePrefix' => 't_',
 ```
 
 В корне проекта запустить команду
 
 ``` php yii migrate ```
 
 после выполнения миграций - создадуться все нужные таблицы в БД
 
 Все готово - заходим на главную и пользуемся.