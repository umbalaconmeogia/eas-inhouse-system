<?php
/**
 * Common configuration for both web and console.
 */
return [
    'bootstrap' => ['log'],
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
//             'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],
                    'except' => ['yii\db\*'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info', 'trace'],
                    'logVars' => [],
                    'categories' => ['yii\db\*'],
                    'logFile' => '@app/runtime/logs/sql.log',
                ],
            ],
        ],
    ],
    'aliases' => [
        '@batsg' => '@app/components/yii2-batsg',
    ],
	'params' => require(__DIR__ . '/params.php'),
    'modules' => require(__DIR__ . '/modules.php'),
];