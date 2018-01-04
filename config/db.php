<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=user_account',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 't_',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 5,
    'schemaCache' => 'cacheFile',
];
