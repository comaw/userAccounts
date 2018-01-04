<?php
/**
 * Created by PhpStorm.
 * User: Manager
 * Date: 19.09.2016
 * Time: 16:10
 */

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'baseUrl' => '/',
    'suffix' => '/',
    'scriptUrl'=>'/index.php',
    'rules' => [
        '' => 'user/index',
        'account' => 'account/index',

        '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<controller:\w+>' => '<controller>/index',
    ],
];
