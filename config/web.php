<?php
return [
	'id' => 'crmapp',
	'basePath' => realpath(__DIR__ . '/../'),
	'bootstrap' => ['debug','log'],
	'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
		/*'firstlevel' => [
			'class' => 'app\utilities\FirstModule',
 		    'modules' => [
				'secondlevel' => [
					'class' => 'app\utilities\SecondModule',
				]
            ]
		],*/
		'debug' => [
			'class' => 'yii\debug\Module',
			#'allowedIPs' => ['IP of your development machine']
		],
		'api' => [
            'class' => 'app\api\ApiModule'
        ]
    ],
	'components' => [
		'request' => [
			'cookieValidationKey' => '5w9joXc0jtUC6bF1RXGm0CjKeIxfOGdw',
		],
		'view' => [
		    'theme' => [
                'class' => yii\base\Theme::className(),
                'basePath' => '@app/themes/snowy',
            ],
			'renderers' => [
				'md' => [
				'class' => 'app\utilities\MarkdownRenderer'
				]
			]
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false
		],
		'response' => [
			'formatters' => [
				'yaml' => [
				'class' => 'app\utilities\YamlResponseFormatter'
				]
			]
		],
		'user' => [
            'identityClass' => 'app\models\user\UserRecord'
        ],
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
		'log' => [
            'traceLevel' =>  3 ,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace','info','error', 'warning'],
                ],
            ],
        ],
		'assetManager' => [
			'bundles' => (require __DIR__ . '/assets_compressed.php')
		],
		'db' => require(__DIR__ . '/db.php'),
	],
    'extensions' => array_merge(
        (require __DIR__ . '/../vendor/yiisoft/extensions.php'),
        [
            'malicious\app-info' => [
                'name' => 'Application Information Dumper',
                'version' => '1.0.0',
                'bootstrap' => '\malicious\Bootstrap',
                'alias' => ['@malicious' => '@app/manual-extension/malicious']
            ]
        ]
    )
];