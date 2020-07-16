<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        "../fontawesome/css/all.css",
    ];
    public $js = [
        'js/backend.js',
        'js/bootbox.min.js',
        "https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js",
    ];
    public $depends = [
        'yii\jui\JuiAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
