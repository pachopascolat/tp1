<?php


namespace backend\assets;


use yii\web\AssetBundle;

class VueRouterAsset extends AssetBundle
{
    public $sourcePath = '@npm/vue-router';
    public $js = [
        'dist/vue-router.js',
//        'dist/vue.runtime.min.js',
//        'dist/vue.common.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        VueAsset::class,
//        AxiosAsset::class
    ];
}
