<?php
$carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
?>
<nav class="nav1 navbar sticky-top">
    <div class="container">
        <div class="w-100 d-flex  align-items-center">
            <div class="logo">
                <a class="navbar-brand d-flex" href="<?= \yii\helpers\Url::base(true) ?>">
                    <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/logotexsim-02.svg" alt="Logo Texsim">
                </a>
            </div>
            
            
            <div class="flex-fill busqueda-div d-none d-md-block">
            <?= \yii\helpers\Html::beginForm(['/sitio/buscar'], 'GET', ['id' => 'busqueda-form','class'=>'navbar-link flex-fill d-flex']);
?>
            <!--<form id="busqueda-form" method="POST" action="<?php // echo \yii\helpers\Url::to(['/sitio/buscar']) ?>" class="navbar-link flex-fill d-flex ">-->
                <input value="<?=$_GET['busqueda']??''?>" id="busqueda" name="busqueda" class="texsim-search-input w-100" type="" placeholder="" aria-label="Search">
                <a href="" onclick="$('#busqueda-form').submit()"> 
                <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-icon">
                </a>
            </form>
            </div>
            <div class="tel nav-item  d-lg-block d-none">
                <span>(54 11) 2120-0550</span>
            </div>
            <div class="d-none d-md-block">
                <div class="contenedor-logos justify-content-between d-flex">
                    <div class="carrito-count-div <?= $carrito && $carrito->itemCarritos ? '' : 'd-none' ?>">
                        <div class="nav-item d-none d-sm-block">
                            <div class="navbar-icon-link2 carrito-link">
                                <a  data-pjax=0
                                    href="<?= yii\helpers\Url::to(['crear-consulta']) ?>" 
                                    class="navbar-icon-link ">

                                    <img class="header-icon" src="<?= \yii\helpers\Url::base(true) . "/img/txsim-header-consulta-01.svg" ?>" alt="listado">
                                    <!--<img class="header-icon" src="img/txsim-header-consulta-01.svg" alt="listado">-->
                                    <div id="item-carrito-count" class="navbar-icon-link-badge carrito-count"><?= $carrito ? count($carrito->itemCarritos) : '' ?></div>

                                </a>
                                <!--                            <div class="tooltiptext tooltiptext-link">
                                                                Haga click aquí para ver su consulta
                                                            </div>-->
                                <div class="tooltiptext tooltiptext-notice">
                                    Su consulta se ha guardado aquí
                                </div>

                            </div>
                            <!--<span class="d-xs-block d-sm-none p-2">Ir a Consulta</span>-->
                        </div>

                    </div>
                    <a class="d-flex align-items-center" href="#"><i class="fab fa-instagram "></i></a>
                    <a class="d-flex align-items-center" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="logo-wp d-flex align-items-center">
                        <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/whatsapp.svg" alt="logo whatsapp">
                    </a>

                </div>
            </div>
        </div> 
    </div>   
</nav> 
