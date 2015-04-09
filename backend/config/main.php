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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<alias:contact|about|login|logout>' => 'site/<alias>',
                /*'<alias:product>/<id:\w+>' => 'site/<alias>',*/
                //'<controller:\w+>/<cate1:\w+>' => '<controller>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<cate1>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<cate1>/<cate2>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<cate1>/<cate2>/<cate3>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<cate1>/<cate2>/<cate3>/<cate4>' => '<controller>/<action>',
            ],
        ],
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
            ],
        ],
        'db' => [
            //'class' => 'yiidbConnection',
            'dsn' => 'mysql:host=localhost;dbname=cmsa',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        'backend/web/bower_components/jquery/dist/jquery.min.js',
                        'backend/web/bower_components/bootstrap/dist/js/bootstrap.min.js',
                        'backend/web/bower_components/metisMenu/dist/metisMenu.min.js',
                        'backend/web/bower_components/DataTables/media/js/jquery.dataTables.min.js',
                        'backend/web/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
                        'backend/web/dist/js/sb-admin-2.js',
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];
