<nav class="navbar navbar-expand-lg navbar-texsim navbar-dark fixed-top">
    <div class="container">
        <div class="w-100 d-flex">
            <a class="navbar-brand d-flex align-items-end" href="/">
                <img class="logo-texsim-blanco p-0" src="img/logotexsim-02.svg">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="menu-container-div d-flex flex-column w-100 ">
                    <div  class="sucursales-div d-flex justify-content-end align-items-center">
                        <div id="sucursales-dir" class="direcciones-sucursales collapse text-light mr-2 ">
                            <span>
                                Lavalle 2571 - 2120 0550 / Feria: Azcuenaga 580 - 2120 0580 / Feria: Olavarria 2348 Villa Celina - 6072 6831
                            </span>
                        </div>
                        <span class="sucursales-toggle text-light" data-toggle="collapse" data-target="#sucursales-dir">Sucursales</span>
                        <!-- Cart Dropdown-->
                        <?php
//                if ($_SESSION['carrito'] != '') :
                        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
//                    if ($carrito->itemCarritos != null) :
                        ?>
                        <div class="carrito-count-div <?= $carrito && $carrito->itemCarritos ? '' : 'd-none' ?>">
                            <div class="nav-item d-none d-sm-block">
                                <div class="navbar-icon-link2 carrito-link">
                                    <a  data-pjax=0
                                        href="<?= yii\helpers\Url::to(['crear-consulta', 'categoria_padre' => $categoria_padre]) ?>" 
                                        class="navbar-icon-link ">

                                        <img class="header-icon" src="img/txsim-header-consulta-01.svg" alt="listado">
                                        <div class="navbar-icon-link-badge carrito-count"><?= $carrito ? count($carrito->itemCarritos) : '' ?></div>

                                    </a>
                                    <div class="tooltiptext tooltiptext-link">
                                        Haga click aquí para ver su consulta
                                    </div>
                                    <div class="tooltiptext tooltiptext-notice">
                                        Su consulta se ha guardado aquí
                                    </div>

                                </div>
                                <span class="d-xs-block d-sm-none p-2">Ir a Consulta</span>
                            </div>

                        </div>

                        <a href="instagram.com/texsim"><i class="fa fa-instagram text-light"></i></a>
                        <a href="facebook.com/texsim"><i class="fa fa-facebook text-light"></i></a>
                        <a target="_blanc" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#"><i class="fa fa-whatsapp text-light"></i></a>
                    </div>
                    <div class="menu-div d-flex justify-content-end">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown text-center">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    INDUMENTARIA
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <?php 
                                    $categorias = \common\models\Categoria::find()->where(['moda'=>true])->all();
                                    foreach ($categorias as $categoria):
                                    ?>
                                    <a data-categoria="<?=$categoria->id_categoria?>" class="dropdown-item ellipses" href="<?= yii\helpers\Url::to(['por-categoria','categoria_id'=>$categoria->id_categoria])?>"><?= $categoria->nombre_categoria ?></a>
                                    <?php endforeach; ?>

                            </li>
                        </ul>
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown text-center">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    HOGAR
                                </a>
                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                    <?php 
                                    $categorias = \common\models\Categoria::find()->where(['hogar'=>true])->all();
                                    foreach ($categorias as $categoria):
                                    ?>
                                    <a data-categoria="<?=$categoria->id_categoria?>" class="dropdown-item ellipses" href="<?= yii\helpers\Url::to(['por-categoria','categoria_id'=>$categoria->id_categoria])?>"><?= $categoria->nombre_categoria ?></a>
                                    <?php endforeach; ?>
                            </li>

                        </ul>
                        <form class="form-inline my-2 my-lg-0 navbar-link flex-fill">
                            <input class="form-control texsim-search-input nav-item w-100" type="search" placeholder="" aria-label="Search">
                            <!--<i class="fa fa-search text-light"></i>-->
                            <img src="img/lupa-01.svg" class="lupa-icon"></img>
                            <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>



</script>