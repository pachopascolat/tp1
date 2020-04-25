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
//        'css/site.css',
//        "css/style.default.css",
//        "css/texsim-css.css",
//        "css/swiper.min.css",
//        "css/owl.carousel.min.css",
//        "css/owl.theme.default.min.css",
//        "css/stylesheet.css",
//        "css/fixedsticky.css",
//        "css/fontawesome.min.css",
//        "css/all.css",
//        "css/bootstrap.min.css"
//        "css/menu-header.css",
        "css/texsim2020.css",
        "fontawesome/css/all.css",
//        "css/oldweb.css",
//        '//fonts.googleapis.com/css?family=Oswald:400,700',
        '//fonts.googleapis.com/css?family=Oswald&display=swap',
        'css/bootstrap-modal-ios.css'
    ];
    public $js = [
//        "js/jquery-3.3.1.min.js",
//        "js/bootstrap.min.js",
//        "js/swiper.min.js",
//        "js/swiper.js",
//        "js/owl.carousel.min.js",
//        "js/owl.carousel2.thumbs.min.js",
//        "js/smooth-scroll.polyfills.min.js",
//        "js/ofi.min.js",
//        "js/theme.js",
//        "js/bootbox.min.js",
//        "js/bootbox.locales.min.js",
//        "js/fixedsticky.js",
//        "js/jquery.sticky-kit.js",
//        "js/texsim.js",
        "js/texsim2020.js",
        "https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js",
        "bootstrap-modal-ios.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\web\JqueryAsset'
    ];

}
