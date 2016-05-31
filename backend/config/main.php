<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['orders'],
                    'logFile' => '@app/runtime/logs/Orders/requests.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['info'],
//                    'categories' => ['pushNotifications'],
//                    'logFile' => '@app/runtime/logs/Orders/notification.log',
//                    'maxFileSize' => 1024 * 2,
//                    'maxLogFiles' => 50,
//                ],
            ],
        ],


        'urlManager' => [
            'showScriptName' => false,   // Disable index.php
            'enablePrettyUrl' => true,   // Disable r= routes
            'enableStrictParsing' => true,
            'rules' => [
                'GET testing' => 'site/testing',
            ]
        ],

    ],
    'params' => $params,
];
