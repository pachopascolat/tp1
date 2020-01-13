<?php
$carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
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
            <!--<form id="busqueda-form" method="POST" action="<?php // echo \yii\helpers\Url::to(['/sitio/buscar'])                             ?>" class="navbar-link flex-fill d-flex ">-->
                <input value="<?= $_GET['busqueda'] ?? '' ?>" id="busqueda" name="busqueda" class="texsim-search-input w-100" type="" placeholder="" aria-label="Search">
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
                <span>(54 11) 2120-0550</span>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <!-- Cart Dropdown-->
            <?php
            $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
            ?>
            <div class="pl-2 pr-2 carrito-count-div  <?= $carrito && $carrito->itemCarritos ? '' : 'd-none' ?>">
                <div class="navbar-icon-link2 carrito-link  ">
                    <div class="d-flex carrito-icon-div">
                        <a  data-pjax=0
                            href="<?= yii\helpers\Url::to(['crear-consulta']) ?>" 
                            class="">
                            <i class=" text-light fal fa-shopping-cart fa-2x"></i>
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
            <a class="" type="button" data-toggle="modal" data-target="#sidebar-left" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <!--<span class="navbar-toggler-icon"></span>-->
                <i class="text-light fal fa-bars fa-2x"></i>
            </a>

        </div>
    </div>
</nav>
<div class="d-lg-none movil-search-bar bg-moda pt-1 pb-1">

    <div class="">
        <!--<div>-->
        <?= \yii\helpers\Html::beginForm(['/sitio/buscar'], 'GET', ['id' => 'busqueda-form', 'class' => 'navbar-link flex-fill d-flex align-items-center']);
        ?>
        <div class="d-flex justify-content-center w-100 align-items-center">
        <!--<form id="busqueda-form" method="POST" action="<?php // echo \yii\helpers\Url::to(['/sitio/buscar'])                             ?>" class="navbar-link flex-fill d-flex ">-->
            <input value="<?= $_GET['busqueda'] ?? '' ?>" id="busqueda" name="busqueda" class="texsim-search-input" type="" placeholder="" aria-label="Search">
            <a href="" onclick="$('#busqueda-form').submit()"> 
                <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-icon">
            </a>
        </div>
        </form>
        <!--</div>-->
    </div>

</div>
<!--</div>-->
<div class="modal fade left modal-sidebar" id="sidebar-left" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content nav1">
            <div class="modal-header border-0 pb-2">
                <div class="pb-2 ">
                    <a class="navbar-brand" href="">
                        <img class="w-100  p-0 " src="<?= \yii\helpers\Url::base(true) . "/img/logotexsim-02.svg" ?>">

                    </a>
                </div>
                <a href="" class="close p-3" data-dismiss="modal" aria-label="Close">
                    <i class="text-white fal fa-times fa-1x"></i>
                </a>
            </div>
            <div class="modal-body">

                <div class="pb-3  borde-movil-gris">
                    <ul class="navbar-nav">

                        <li class="nav-item item-categoria-padre">
                            <a class="pb-1 pt-0" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>" id="" >
                                <h6 class="text-moda">MODA</h6>
                            </a>
                        </li>
                        <?php
                        $categorias = \common\models\Categoria::find()->where(['moda' => true])->all();
                        foreach ($categorias as $categoria):
                            ?>
                            <li class="nav-item item-categoria">
                                <a class="nav-link p-0" data-categoria="<?= $categoria->id_categoria ?>"  href="<?= yii\helpers\Url::to(['por-categoria', 'id_categoria' => $categoria->id_categoria]) ?>">
                                    <span class="movil-categorias"><?= $categoria->nombre_categoria ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class=" borde-movil-gris pb-3 pt-3 ">
                    <ul class="navbar-nav">

                        <li class="nav-item item-categoria-padre">
                            <a class="pb-1 movil-categoria-padre" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>" id="" >
                                <h6 class="text-hogar">HOGAR</h6>
                            </a>
                        </li>
                        <?php
                        $categorias = \common\models\Categoria::find()->where(['hogar' => true])->all();
                        foreach ($categorias as $categoria):
                            ?>
                            <li class="nav-item item-categoria">
                                <a class="nav-link p-0" data-categoria="<?= $categoria->id_categoria ?>"  href="<?= yii\helpers\Url::to(['por-categoria', 'id_categoria' => $categoria->id_categoria]) ?>">
                                    <span class="movil-categorias"><?= $categoria->nombre_categoria ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="borde-movil-gris pb-3 pt-3 ">
                    <a href="" class="w-100 d-flex justify-content-between align-items-center" data-target="#side-menu-telas" id="" role="button" data-toggle="collapse" >
                        <span class="movil-categorias">Telas</span>
                        <i class="movil-categorias fa fa-chevron-down"></i>
                    </a>
                    <div id="side-menu-telas" class="collapse pt-2">
                        <ul class="navbar-nav">

                            <?php
                            $vidrieras = \common\models\Vidriera::find()->joinWith('categoria')->where(['categoria_padre' => [1, 2]])->all();
                            foreach ($vidrieras as $vidriera):
                                ?>
                                <li class="nav-item item-categoria">
                                    <a class="nav-link p-0" href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera->id_vidriera]) ?>">
                                        <span class="movil-categorias text-light"><?= $vidriera->nombre ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>


                        </ul>
                    </div>
                </div>

                <div class="borde-movil-gris side-menu-social-iconos pt-3 pb-3">
                    <a class="mr-3"  href="instagram.com/texsim"><i class="fab fa-instagram text-light"></i></a>
                    <a class="mr-3" href="facebook.com/texsim"><i class="fab fa-facebook text-light"></i></a>
                    <a class="mr-3" target="_blanc" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#"><i class="fab fa-whatsapp text-light"></i></a>

                </div>
                <div class="nav-item text-white pt-3">
                    <a>
                        <span class="movil-categorias">
                            CONSULTAS  
                        </span>
                        <span class="text-light">2120 0550</span>
                    </a>
                </div>
                <div class="nav-item side-menu-sucursales ">
                    <a href="" class="w-100 d-flex justify-content-between align-items-center side-menu-link cursor-pointer text-blue d-inline" data-target="#side-menu-suc-dir" id="" role="button" data-toggle="collapse" >
                        <span class="movil-categorias">sucursales</span>
                        <i class="movil-categorias fa fa-chevron-down"></i>
                    </a>

                    </a>


                    <div id="side-menu-suc-dir" class="collapse dir-sucursales text-light" aria-labelledby="navbarDropdown">
                        <div><span class="">Lavalle 2571 / 2120 0550</span> </div>
                        <div><span class="">Azcuenaga 580 / 2120 0580</span></div>
                        <div><span class="">Olavarria 2348 / 6072 6831</span></div>
                        <div><span class="">Villa Celina</span></div>
                    </div>

                </div>

                <div class="side-menu-login nav-item">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <a href="" class="side-menu-link text-white cursor-pointer" data-toggle="modal" data-target="#login-modal">
                                <!--<i style="" class="fa fa-lock "></i>-->
                            <span class="movil-categorias">LOGIN</span>
                            <!--<span class="d-xs-block d-sm-none">Login</span>-->

                        </a>

                        <?php
                    } else {
                        echo '<i style="" class="fa fa-lock header-icon d-xs-block d-sm-none "></i>';
                        echo \yii\helpers\Html::beginForm(['/user/logout'], 'post');
                        ?>
                        <button name="logout" class="btn text-light logout-btn" onclick="$('form').submit()">
                            <span>Logout(<?= Yii::$app->user->identity->username ?>)</span>
                        </button>
                        <?php
//                                echo \yii\helpers\Html::submitButton(
////                                        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn text-white word-break', 'name' => 'logout']
//                                        'Logout', ['class' => 'text-white nav-link p-0 ml-1', 'name' => 'logout']
//                                );
                        echo \yii\helpers\Html::endForm();
                    }
                    ?>
                </div>


            </div>
        </div>
    </div>
</div>