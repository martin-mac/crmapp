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
		'db' => require(__DIR__ . '/db.php'),
	],
];