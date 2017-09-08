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
        '/css/site.css',
        //'css/style.css',
        'css/font-awesome-4.7.0/css/font-awesome.min.css',
    ];
    public $js = [
        'js/app.js',
        'js/sidebar-follow.js',
        //'js/global.js',
        //'js/jquery.min.js',
        //'js/wp-embed.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
