<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta name="format-detection" value="telephone=no">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">--> 

        <?= Html::csrfMetaTags() ?>
        <title>TexsimDigital</title>
        <!--        <link rel="stylesheet" href="css/bootstrap.min.css">
                <link rel="stylesheet" href="css/style.default.min.css">
                <link rel="stylesheet" href="css/texsim-css.css">
                <link rel="stylesheet" href="css/swiper.min.css">
                <link rel="stylesheet" href="css/owl.carousel.css">
                <link rel="stylesheet" href="css/stylesheet.css">-->
        <!--<link rel="stylesheet" href="css/fixedsticky.css">-->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--> 

        <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">-->

        <!--<link rel="stylesheet" href="css/all.css" >-->
        <!--        <link rel="stylesheet" href="css/solid.css" >
                <link rel="stylesheet" href="css/regular.css">
                <link rel="stylesheet" href="css/brands.css" >
                <link rel="stylesheet" href="css/fontawesome.css" >-->
        <!--<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">-->
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="120x120" href="<?= yii\helpers\Url::base(true)?>/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= yii\helpers\Url::base(true)?>/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= yii\helpers\Url::base(true)?>/img/favicon-16x16.png">
        <link rel="manifest" href="<?= yii\helpers\Url::base(true)?>/img/site.webmanifest">
        <link rel="mask-icon" href="<?= yii\helpers\Url::base(true)?>/img/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#ffffff">
        <script>
            var basePath = '';
        </script>

        <?php $this->head() ?>

    </head>
    <body>
        <?php $this->beginBody() ?>
<?= $this->render('nav1')?>
<?= $this->render('nav2')?>
        <!--<div class="">-->
        <?= $content ?>
        <br>
        <div class="d-none d-lg-block">
        <?php echo $this->render('footer')?>
        </div>
        <!--</div>-->
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
