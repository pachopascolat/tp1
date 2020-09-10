<?php
$session = $_SESSION['carrito']??'';
$carrito = \common\models\Carrito::findOne($session);
?>
<nav class="nav1 navbar sticky-top d-none d-lg-block">
    <div class="container">
        <div class="w-100 d-flex  align-items-center">
            <div class="logo">
                <a class="navbar-brand d-flex" href="<?= \yii\helpers\Url::base(true) ?>">
                    <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/logotexsim-02.svg" alt="Logo Texsim">
                </a>
            </div>


            <div class="flex-fill busqueda-div d-none d-md-block">
                <?= \yii\helpers\Html::beginForm(['/sitio/buscar'], 'GET', ['id' => 'busqueda-form', 'class' => 'navbar-link flex-fill d-flex align-items-center']);
                ?>
            <!--<form id="busqueda-form" method="POST" action="<?php // echo \yii\helpers\Url::to(['/sitio/buscar'])                              ?>" class="navbar-link flex-fill d-flex ">-->
                <input value="<?= $_GET['busqueda'] ?? '' ?>" id="busqueda" name="busqueda" class="texsim-search-input w-100" type="" placeholder="" aria-label="Search">
                <a href="" onclick="$('#busqueda-form').submit()">
                    <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-icon">
                </a>
                </form>
            </div>
            <div class="tel nav-item  d-lg-block d-none">
                <a href="tel:+541121200550" class="text-light"><span>(54 11) 2120-0550</span></a>
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
                    <a target="_blanc" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#" class="logo-wp d-flex align-items-center">
                        <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/whatsapp.svg" alt="logo whatsapp">
                    </a>

                </div>
            </div>
        </div>
        <div id="sucursales-dir" class="collapse  text-light w-100">
            <div class="d-flex w-100 justify-content-end">
                <span class="">
                    Lavalle 2571 - 2120 0550 / Feria: Azcuenaga 580 - 2120 0580 / Feria: Olavarria 2348 Villa Celina - 6072 6831
                </span>
            </div>
        </div>
    </div>
</nav>

<!--<div class="d-lg-none">-->
<nav class="navbar-movil navbar navbar-texsim navbar-dark nav1 sticky-top d-lg-none">
    <!--<div class="">-->
    <div class="d-flex align-items-center w-100">
        <!--<div class="movil-logo-div">-->
        <a class="movil-logo-div navbar-brand" href="/">
            <img class="img-fluid" src="<?= \yii\helpers\Url::base(true) . "/img/logotexsim-02.svg" ?>">
        </a>
        <!--</div>-->
        <!--<div class="">-->
        <!--<div class="d-flex">-->
        <div class="flex-fill d-flex align-items-center justify-content-center">
            <div class="nav-item text-light tel-movil">
                <a href="tel:+541121200550" class="text-light"><span>(54 11) 2120-0550</span></a>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <!-- Cart Dropdown-->
            <?php
            $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
            ?>
            <div class="pl-3 pr-3 carrito-count-div  <?= $carrito && $carrito->itemCarritos ? '' : 'd-none' ?>">
                <div class="navbar-icon-link2 carrito-link  ">
                    <div class="d-flex carrito-icon-div">
                        <a  data-pjax=0
                            href="<?= yii\helpers\Url::to(['crear-consulta']) ?>"
                            class="">
                            <!--<i class=" text-light fal fa-clipboard fa-2x"></i>-->
                            <i class="text-light fal fa-clipboard-check"></i>
                        </a>
                        <div class="navbar-icon-link-badge carrito-count"><?= $carrito ? count($carrito->itemCarritos) : '' ?></div>
                    </div>
                    <div class="tooltiptext tooltiptext-link">
                        Haga click aquí para ver su consulta
                    </div>
                    <div class="tooltiptext tooltiptext-notice">
                        Su consulta se ha guardado aquí
                    </div>
                </div>
            </div>
            <a href="#sidebar-left" class="cursor-pointer" data-toggle="modal" data-target="#sidebar-left" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <!--<span class="navbar-toggler-icon"></span>-->
                <i class="text-light fal fa-bars fa-2x"></i>
            </a>

        </div>
    </div>
</nav>
<div class="d-lg-none movil-search-bar bg-moda pt-1 pb-1">

    <div class="">
        <!--<div>-->
        <?= \yii\helpers\Html::beginForm(['/sitio/buscar'], 'GET', ['id' => 'movil-busqueda-form', 'class' => 'navbar-link flex-fill d-flex align-items-center']);
        ?>
        <div class="d-flex justify-content-center w-100 align-items-center">
        <!--<form id="busqueda-form" method="POST" action="<?php // echo \yii\helpers\Url::to(['/sitio/buscar'])                              ?>" class="navbar-link flex-fill d-flex ">-->
            <input value="<?= $_GET['busqueda'] ?? '' ?>" id="busqueda-movil" name="busqueda" class="texsim-search-input" type="" placeholder="" aria-label="Search">
            <a class="lupa-link" href="" onclick="">
                <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-icon">
            </a>
        </div>
        </form>
        <!--</div>-->
    </div>

</div>
<!--</div>-->
<?= $this->render('_modal_movil_menu')?>
