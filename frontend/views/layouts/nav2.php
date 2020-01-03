<div class="nav2">

    <!--<img src="./imgHeader2/faja-02.jpg" class="nav2-img">-->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/faja-01.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/faja-02.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/faja-03.jpg" alt="Third slide">
            </div>
        </div>
    </div>

    <div class="absolute-div w-100">
        <nav class="navbar">
            <div class="container">

                <div class="w-100 d-flex justify-content-end">
                    <ul class="navbar-nav navbar-expand">
                        <li class="nav-item">
                            <a class="" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#">Mis Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#">Ayuda</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#">Sucursales</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#">
                                <img src="">
                            </a>
                        </li>
                        <li class="nav-item navbar-icon-link">
                            <div class="text-white" data-toggle="modal" data-target="#login-modal">
                                <i style="" class="fas fa-lock svg-icon "></i>
                                <span class="d-xs-block d-sm-none">Login</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
    <div class="nav3">
        <div class="container">
            <div class="d-flex justify-contend-between">
                <div class="navbar navbar-expand w-100 pl-0">
                    <ul class="navbar-nav text-grey">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ordenar Publicaciones
                            </a>
                            <!--<i class="far fa-angle-down"></i>-->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Moda
                                <!--<i class="far fa-angle-down"></i>-->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                <?php 
                                $categoriasModa = \common\models\Categoria::find()->where(['moda'=>true])->all();
                                foreach ($categoriasModa as $catMod):
                                ?>
                                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria','id_categoria'=>$catMod->id_categoria])?>"><?= $catMod->nombre_categoria?></a>
                                <!--<a class="dropdown-item" href="#">Another action2</a>-->
                                <!--<a class="dropdown-item" href="#">Something else here2</a>-->
                                <?php endforeach; ?>
                            </div>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hogar
                                <!--<i class="far fa-angle-down"></i>-->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink3">
                                
                                <?php 
                                $categoriasHogar = \common\models\Categoria::find()->where(['hogar'=>true])->all();
                                foreach ($categoriasHogar as $catHog):
                                ?>
                                <a class="dropdown-item" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria','id_categoria'=>$catHog->id_categoria])?>"><?= $catHog->nombre_categoria?></a>
                                <!--<a class="dropdown-item" href="#">Another action2</a>-->
                                <!--<a class="dropdown-item" href="#">Something else here2</a>-->
                                <?php endforeach; ?>
                            </div>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Telas
                                <!--<i class="far fa-angle-down"></i>-->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink4">
                                <?php
                                $telas = \common\models\Vidriera::find()->all();
                                foreach ($telas as $tela):
                                    ?>
                                <a class="dropdown-item" href="<?= yii\helpers\Url::to(['/sitio/por-vidriera','id'=>$tela->id_vidriera])?>"><?= $tela->nombre?></a>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </li>

                    </ul>

                </div>
                <div class="d-flex">
                    <div>
                        <a href="<?= \yii\helpers\Url::to(['/sitio/hogar'])?>">
                            <img alt="icono hogar" class="logo-hogar logo" src="<?= \yii\helpers\Url::base(true) ?>/img2020/hogar-70x70.svg">
                        </a>
                    </div>
                    <div>
                        <a href="<?= \yii\helpers\Url::to(['/sitio/moda'])?>">
                            <img alt="icono moda" class="logo-moda logo" src="<?= \yii\helpers\Url::base(true) ?>/img2020/moda-70x70-01.svg">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>