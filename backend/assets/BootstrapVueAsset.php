<?php


namespace backend\assets;


use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

class BootstrapVueAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap-vue';

    public $css = [
        'dist/bootstrap-vue.min.css',
    ];

    public $js = [
        'dist/bootstrap-vue.min.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        BootstrapAsset::class,
        VueAsset::class,
        BootstrapPluginAsset::class,
    ];
}
