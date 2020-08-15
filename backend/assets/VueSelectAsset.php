<?php


namespace backend\assets;


use yii\web\AssetBundle;

class VueSelectAsset extends AssetBundle
{
    public $sourcePath = '@npm/vue-select';
    public $js = [
//        '',
//        'dist/vue.runtime.min.js',
        'dist/vue-select.js',
    ];
    public $css = [
        'dist/vue-select.css'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        VueAsset::class,
//        AxiosAsset::class
    ];

}
