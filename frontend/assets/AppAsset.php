<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        "css/style.default.css",
        "css/texsim-css.css",
        "css/swiper.min.css",
        "css/owl.carousel.min.css",
        "css/owl.theme.default.min.css",
        
        "css/stylesheet.css",
        "css/fixedsticky.css",
//        "css/fontawesome.min.css",
        "css/all.css",
//        "css/bootstrap.min.css"
    ];
    public $js = [
//        "js/jquery-3.3.1.min.js",
//        "js/bootstrap.min.js",
        "js/swiper.min.js",
//        "js/swiper.js",
        "js/owl.carousel.min.js",
//        "js/owl.carousel2.thumbs.min.js",
        "js/smooth-scroll.polyfills.min.js",
        "js/ofi.min.js",
        "js/theme.js",
//        "js/bootbox.min.js",
//        "js/bootbox.locales.min.js",
        "js/fixedsticky.js",
        "js/jquery.sticky-kit.js",
        "js/texsim.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\web\JqueryAsset'
    ];

}
