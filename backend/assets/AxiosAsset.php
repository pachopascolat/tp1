<?php


namespace backend\assets;


use yii\web\AssetBundle;

class AxiosAsset extends AssetBundle
{
    public $sourcePath = '@npm/axios';
    public $js = [
        'dist/axios.min.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
