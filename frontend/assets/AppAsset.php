<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		['css/dropdown-menu.css', 'media' => 'print, screen'],
		['css/main-page2.css', 'media' => 'print, screen'],
		['css/styles.css', 'media' => 'print, screen'],
		['css/feedback.css', 'media' => 'print, screen'],
		['css/redesign.css', 'media' => 'print, screen'],

	];
	public $js = [
		['js/dropdown_menu.js', 'media' => 'print, screen'],
//		['js/init-svg.js', 'media' => 'print, screen'],
		['js/script.js', 'media' => 'print, screen'],
	];
	public $depends = [
		'yii\web\YiiAsset',
//		'yii\jui\JuiAsset',
//		'yii\bootstrap\BootstrapAsset',
	];
}
