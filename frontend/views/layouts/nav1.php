<?php
$carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
?>
<nav class="nav1 navbar sticky-top">
    <div class="container">
        <div class="w-100 d-flex justify-content-around align-items-center">
            <div class="logo">
                <a class="navbar-brand d-flex" href="#">
                    <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/logotexsim-02.svg" alt="Logo Texsim">
                </a>
            </div>
            <form method="POST" action="/buscador" class="navbar-link flex-fill d-flex ">
                <input id="busqueda" name="busqueda" class="texsim-search-input w-100" type="search" placeholder="" aria-label="Search">
                <!--<i class="fa fa-search text-light"></i>-->
                <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-icon">
                <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
            </form>
            <div class="tel nav-item  d-lg-block d-none">
                <span>(54 11) 2120-0550</span>
            </div>
            <div class="contenedor-logos d-flex  justify-content-between">
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
</nav> 
