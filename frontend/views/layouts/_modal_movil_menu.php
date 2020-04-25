<div class="modal fade left modal-sidebar" id="sidebar-left" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content nav1">
            <div class="modal-header sticky-top  border-0 pb-2">
                <div class="pb-2 ">
                    <a class="navbar-brand" href="">
                        <img class="w-100  p-0 " src="<?= \yii\helpers\Url::base(true) . "/img/logotexsim-02.svg" ?>">

                    </a>
                </div>
                <a href="" class="close p-3" data-dismiss="modal" aria-label="Close">
                    <i class="text-white fal fa-times"></i>
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
                            $vidrieras = \common\models\Vidriera::find()->joinWith('categoria')->where(['categoria_padre' => [1, 2]])->orderBy('nombre')->all();
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
                     <a href="<?= yii\helpers\Url::to(['/sitio/crear-consulta'])?>">
                        <span class="movil-categorias">
                            Pedidos
                        </span>

                    </a>
                </div>
                 <div class="nav-item text-white">
                     <a href="" data-toggle="modal" data-target="#pdf-report-modal">
                        <span class="movil-categorias">
                            CATALOGO
                        </span>

                    </a>
                </div>
                <div class="nav-item text-white">
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
//                        echo '<i style="" class="fa fa-lock header-icon d-xs-block d-sm-none "></i>';
                        echo \yii\helpers\Html::beginForm(['/user/logout'], 'post',['id'=>'movil-logout-form','class'=>'m-0']);
                        ?>
                        <div  class="text-light logout-btn" onclick="$('#movil-logout-form').submit()">
                            <span class="movil-categorias">Logout(<?= Yii::$app->user->identity->username ?>)</span>
                        </div>
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
