<?php
return [
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => ['start'],
	'components' => [
		'start' => 'common\components\StartComponent',
		'sypexGeo' => [
			'class' => 'omnilight\sypexgeo\SypexGeo',
			'database' => '@frontend/helpers/sypexGeo/data/SxGeoCity.dat',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
			'defaultDuration' => 60 * 60 * 8
		],
		'i18n' => [
			'translations' => [
				'yii2mod.rbac' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@yii2mod/rbac/messages',
				],
			],
		],
		'assetManager' => [
			'linkAssets' => true,
			'appendTimestamp' => true
		],
		'formatter' => [
			'class' => '\yii\i18n\Formatter',
			'nullDisplay' => '&nbsp;',
			'thousandSeparator' => ' ',
			'locale' => 'ru-RU',
			'defaultTimeZone' => 'Europe/Moscow',
			'dateFormat' => 'dd.MM.yyyy',
			'datetimeFormat' => 'dd.MM.yyyy, HH:mm:ss',
			'timeFormat' => 'HH:mm:ss'
		],
		'monolog' => [
			'class' => '\Mero\Monolog\MonologComponent',
			'channels' => [
				'main' => [
					'handler' => [
						[
							'type' => 'stream',
							'path' => '@frontend/runtime/logs/main_' . date('Y-m-d') . '.log',
							'level' => 'debug'
						]
					],
					'processor' => [],
				],
			],
		],
	],
	'language' => 'ru-RU',
	'sourceLanguage' => 'ru-RU',
	'timeZone' => 'Europe/Moscow',
	'name' => 'Isuzu'
];
