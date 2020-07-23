<?php


namespace backend\assets;


use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $sourcePath = '@npm/vue';
    public $js = [
        'dist/vue.min.js',
//        'dist/vue.runtime.min.js',
//        'dist/vue.common.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
//        AxiosAsset::class
    ];
}
