<?php
return [
	'id' => 'crmapp',
	'basePath' => realpath(__DIR__ . '/../'),
	'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
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
		'db' => require(__DIR__ . '/db.php'),
	],
];