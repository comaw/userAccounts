<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage'=>'en_US',
    'language' => 'en',
    'charset' => 'UTF-8',
    'timeZone' => 'Europe/Kiev',
    'name' => 'Users Accounts',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'J4gtyO_ZSymE1fghfgfi8_4O5-G5Kp_-qT7oM',
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\DbCache',
        ],
        'cacheFile' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'timeZone' => 'Europe/Kiev',
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => '',
        ],
        'user' => [
            'identityClass' => 'app\models\login\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => include (__DIR__ . '/urlManager.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
