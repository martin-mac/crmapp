<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
//Yii::setAlias('@webroot', __DIR__ . '/../web');
Yii::setAlias('@webroot', '\xampp\htdocs\crmapp\web');
Yii::setAlias('@web', '/');
//Yii::setAlias('@web', '/');


return [
    // Adjust command/callback for JavaScript files compressing:
    'jsCompressor' => 'java -jar assets/compression/compiler.jar --js {from} --js_output_file {to}',
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => 'java -jar assets/compression/yuicompressor.jar --type css {from} -o {to} -v',
    // The list of asset bundles to compress:
    'bundles' => [
         //'app\assets\AppAsset',
         //'app\assets\ApplicationUiAssetBundle',
         'app\assets\SnowAssetsBundle',
		 'yii\widgets\ActiveFormAsset',
         'yii\grid\GridViewAsset',
         'yii\validators\ValidationAsset',
         'yii\web\YiiAsset',
         'yii\web\JqueryAsset',
    ],
    // Asset bundle for compression output:
    /*
	'targets' => [
        'all' => [
            'class' => 'yii\web\AssetBundle',
            #'basePath' => '@webroot/assets',
            'basePath' => realpath(__DIR__ . '/../../web'),
            #'baseUrl' => '@web/assets',
            'baseUrl' => '/',
            #'js' => 'js/all-{hash}.js',
			'js' => 'compiled-assets/all-{hash}.js',
            #'css' => 'css/all-{hash}.css',
			'css' => 'compiled-assets/all-{hash}.css',
        ],
    ],
	*/
	'targets' => [
		'app\\assets\\AllAsset' => [
			#'basePath' => realpath(__DIR__ . '/../../web'),
			#'basePath' => '\xampp\htdocs\crmapp\web',
			'basePath' => '@webroot',
			#'baseUrl' => '/',
			'baseUrl' => '@web',
			'js' => 'compiled-assets/all-{hash}.js',
			'css' => 'compiled-assets/all-{hash}.css',
		],
	],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '/assets',
		#'basePath' => realpath(__DIR__ . '/../../web/assets'),
        #'baseUrl' => '/assets',
    ],
];