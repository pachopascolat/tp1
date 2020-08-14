<?php


namespace backend\assets;


use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

class BootstrapVueAsset extends AssetBundle
{
    public $sourcePath = '@npm';

    public $css = [
//        'bootstrap/dist/css/bootstrap.min.css',
        'bootstrap-vue/dist/bootstrap-vue.css',

    ];

    public $js = [
//        'vue/dist/vue.js',
        'bootstrap-vue/dist/bootstrap-vue.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
//        BootstrapAsset::class,
//        BootstrapPluginAsset::class,
//        VueAsset::class,
    ];
}
