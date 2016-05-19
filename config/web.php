<?php
return [
	'id' => 'crmapp',
	'basePath' => realpath(__DIR__ . '/../'),
	'components' => [
		'request' => [
			'cookieValidationKey' => '5w9joXc0jtUC6bF1RXGm0CjKeIxfOGdw',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false
		],
		'db' => require(__DIR__ . '/db.php'),
	],
];