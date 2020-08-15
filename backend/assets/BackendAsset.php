<?php


namespace backend\assets;


use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        "../fontawesome/css/all.css",
//        "https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css",
    ];
    public $js = [
//        'js/backend.js',
//        'js/bootbox.min.js',
//        "https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js",
//        "https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js",
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        BootstrapAsset::class,
        VueAsset::class,
        BootstrapVueAsset::class,
        VueSelectAsset::class,
        AxiosAsset::class,
//        AxiosAsset::class
    ];
}
