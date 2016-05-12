<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qQL3v2gOSxJz8oq3lpFVzDo64xhIgYBP',
            'parsers' => [
              'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => false,
            /* Disable session */
            'enableSession' => true,
            // 'loginUrl' => null,
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
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                      'websvc8000' => 'websvc8000',
                      'websvc8010' => 'websvc8010',
                      'websvc8020' => 'websvc8020',
                      'websvc8030' => 'websvc8030',
                      'websvc8040' => 'websvc8040',
                    ],
                    'extraPatterns' => [ // patterns
                        'OPTIONS daftar-petani' => 'options',
                        'OPTIONS daftar-semua-petani' => 'options',
                        'OPTIONS daftar-lahan' => 'options',
                        'OPTIONS daftar-semua-lahan' => 'options',
                        'OPTIONS daftar-produksi' => 'options',
                        'OPTIONS daftar-varietas' => 'options',
                        'OPTIONS daftar-lokasi' => 'options',
                        'OPTIONS acuan-harga' => 'options',
                        'OPTIONS tambah-produksi' => 'options',
                        'OPTIONS tambah-petani' => 'options',
                        'OPTIONS tambah-lahan' => 'options',
                        'OPTIONS update-pemilik-lahan' => 'options',
                        'OPTIONS edit-lahan' => 'options',
                        'OPTIONS edit-petani' => 'options',
                        'OPTIONS edit-produksi' => 'options',
                        'OPTIONS delete-lahan' => 'options',
                        'OPTIONS delete-petani' => 'options',
                        'OPTIONS delete-produksi' => 'options',
                        'OPTIONS delete-varietas' => 'options',
                        'OPTIONS ganti-password' => 'options',
                        //'OPTIONS daftar-produksi' => 'options',
                    ]
                ]
            ]
        ],
    ],
    'as access' => [
      'class' => '\hscstudio\mimin\components\AccessControl',
      'allowActions' => [
        'site/*',
        'debug/*',
        'mimin/*'   // only in dev mode
      ],
    ],
    'modules' => [
        'utility' => [
            'class' => 'c006\utility\migration\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'mimin' => [
          'class' => '\hscstudio\mimin\module',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
