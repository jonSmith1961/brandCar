<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
	    'css/bootstrap-select.min.css',
	    'css/site.css',
	    'css/styles-admin.css',
    ];
    public $js = [
	    'js/bootstrap-select.min.js',
	    'js/i18n/defaults-ru_RU.min.js',
	    'js/common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
