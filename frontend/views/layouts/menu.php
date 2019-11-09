<div class="sticky-top">

    <!--nav para pantallas de escritorio-->

    <div class="d-none d-lg-block">
        <nav class="navbar-escritorio navbar navbar-expand-lg navbar-texsim navbar-dark d-sm-none d-lg-flex">
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
                            <div  class="sucursales-div d-flex justify-content-end">
                                <div class="direcciones-sucursales d-flex justify-content-end align-items-center">
                                    <div id="sucursales-dir" class="collapse text-light mr-2">
                                        <span>
                                            Lavalle 2571 - 2120 0550 / Feria: Azcuenaga 580 - 2120 0580 / Feria: Olavarria 2348 Villa Celina - 6072 6831
                                        </span>
                                    </div>
                                    <div class="sucursales-toggle">
                                        <span class="text-light" data-toggle="collapse" data-target="#sucursales-dir">Sucursales</span>
                                    </div>
                                </div>
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
                                                href="<?= yii\helpers\Url::to(['crear-consulta']) ?>" 
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
                                <div class="">
                                    <?php if (Yii::$app->user->isGuest) { ?>
                                        <div class=" text-white" data-toggle="modal" data-target="#login-modal">
                                            <i style="" class="fa fa-lock "></i>
                                            <!--<span class="d-xs-block d-sm-none">Login</span>-->

                                        </div>

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
                            <div class="menu-div d-flex justify-content-end">
                                <ul class="navbar-nav">

                                    <li class="nav-item dropdown text-center">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            INDUMENTARIA
                                        </a>
                                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                            <?php
                                            $categorias = \common\models\Categoria::find()->where(['moda' => true])->all();
                                            foreach ($categorias as $categoria):
                                                ?>
                                                <a data-categoria="<?= $categoria->id_categoria ?>" class="dropdown-item ellipses" href="<?= yii\helpers\Url::to(['por-categoria', 'categoria_id' => $categoria->id_categoria]) ?>"><?= $categoria->nombre_categoria ?></a>
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
                                            $categorias = \common\models\Categoria::find()->where(['hogar' => true])->all();
                                            foreach ($categorias as $categoria):
                                                ?>
                                                <a data-categoria="<?= $categoria->id_categoria ?>" class="dropdown-item ellipses" href="<?= yii\helpers\Url::to(['por-categoria', 'categoria_id' => $categoria->id_categoria]) ?>"><?= $categoria->nombre_categoria ?></a>
                                            <?php endforeach; ?>
                                    </li>

                                </ul>
                                <form method="POST" action="<?= \yii\helpers\Url::to(['/texsim/buscar-telas']) ?>"  class="form-inline my-2 my-lg-0 navbar-link flex-fill">
                                    <input id="busqueda" name="busqueda" class="form-control texsim-search-input nav-item w-100" type="search" placeholder="" aria-label="Search">
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
    </div>

    <!--nav para pantallas moviles-->

    <div class="d-lg-none">
        <nav class="navbar-movil navbar navbar-texsim navbar-dark">
            <div class="container">
                <div class="w-100 d-flex align-items-center">
                    <a class="navbar-brand p-0" href="/">
                        <img class="img-fluid p-0" src="img/logotexsim-02.svg">

                    </a>
                    <div class="d-flex w-100 justify-content-end">
                        <!-- Cart Dropdown-->
                        <?php
                        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
                        ?>
                        
                        <div class="carrito-count-div align-items-center <?= $carrito && $carrito->itemCarritos ? 'd-flex' : 'd-none' ?>">
                            <div class="navbar-icon-link2 carrito-link">
                                <a  data-pjax=0
                                    href="<?= yii\helpers\Url::to(['crear-consulta']) ?>" 
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

                            <!--<span class="d-xs-block d-sm-none p-2">Ir a Consulta</span>-->
                            </div>

                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="modal" data-target="#sidebar-left" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <!-- Sidebar Left -->

                    <!--                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                                        </div>-->
                </div>
            </div>
        </nav>
    </div>






</div>

<!--modal de sidebar menu-->


<div class="modal fade left modal-sidebar" id="sidebar-left" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a class="navbar-brand d-flex align-items-end w-100 pr-3 pb-0" href="/">
                    <img class=" img-fluid p-0 " src="img/logotexsim-02.svg">

                </a>
            </div>
            <div class="modal-body">
                <div class="side-menu-indumentaria mb-3 mt-0">
                    <ul class="navbar-nav">

                        <li class="nav-item item-categoria-padre">
                            <a class="nav-link pt-0" href="#" id="" >
                                INDUMENTARIA
                            </a>
                        </li>
                        <?php
                        $categorias = \common\models\Categoria::find()->where(['moda' => true])->all();
                        foreach ($categorias as $categoria):
                            ?>
                            <li class="nav-item item-categoria">
                                <a class="nav-link p-0" data-categoria="<?= $categoria->id_categoria ?>"  href="<?= yii\helpers\Url::to(['por-categoria', 'categoria_id' => $categoria->id_categoria]) ?>"><?= $categoria->nombre_categoria ?></a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="side-menu-hogar mb-3">
                    <ul class="navbar-nav">

                        <li class="nav-item item-categoria-padre">
                            <a class="nav-link" href="#" id="" >
                                hogar
                            </a>
                        </li>
                        <?php
                        $categorias = \common\models\Categoria::find()->where(['hogar' => true])->all();
                        foreach ($categorias as $categoria):
                            ?>
                            <li class="nav-item item-categoria">
                                <a class="nav-link p-0" data-categoria="<?= $categoria->id_categoria ?>"  href="<?= yii\helpers\Url::to(['por-categoria', 'categoria_id' => $categoria->id_categoria]) ?>"><?= $categoria->nombre_categoria ?></a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="side-menu-social-iconos">
                    <a href="instagram.com/texsim"><i class="fa fa-instagram text-light"></i></a>
                    <a href="facebook.com/texsim"><i class="fa fa-facebook text-light"></i></a>
                    <a target="_blanc" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#"><i class="fa fa-whatsapp text-light"></i></a>
                    <div class="d-inline-block">
                        <?php if (Yii::$app->user->isGuest) { ?>
                            <div class=" text-white" data-toggle="modal" data-target="#login-modal">
                                <i style="" class="fa fa-lock "></i>
                                <!--<span>Login</span>-->
                                <!--<span class="d-xs-block d-sm-none">Login</span>-->

                            </div>

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
                <div class="side-menu-consultas text-white mb-3">
                    <a> 
                        consultas 2120 0550 
                    </a>
                </div>
                <div class="side-menu-login mb-3">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <div class="side-menu-link text-white cursor-pointer" data-toggle="modal" data-target="#login-modal">
                            <!--<i style="" class="fa fa-lock "></i>-->
                            <span>Login</span>
                            <!--<span class="d-xs-block d-sm-none">Login</span>-->

                        </div>

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
                <div class="side-menu-sucursales mb-3">
                    <div class="side-menu-link cursor-pointer" href="#" data-target="#side-menu-suc-dir" id="" role="button" data-toggle="collapse" >
                        sucursales
                    </div>
                    <div id="side-menu-suc-dir" class="collapse dir-sucursales" aria-labelledby="navbarDropdown">
                        <div><span class="text-blue">Lavalle 2571 / 2120 0550</span> </div>
                        <div><span class="text-blue">Azcuenaga 580 / 2120 0580</span></div>
                        <div><span class="text-blue">Olavarria 2348 / 6072 6831</span></div>
                        <div><span class="text-blue">Villa Celina</span></div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


<!--modal de login-->

<div id="login-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $user = Yii::createObject(dektrium\user\models\LoginForm::className());

//            echo  Html::beginForm(['/user/login'], 'post');
            $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'login-form',
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                        'action' => ['/user/login']
            ]);
            ?>
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">




                                <?=
                                $form->field($user, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'autocomplete' => "username"]]
                                );
                                ?>



                                <?=
                                        $form->field(
                                                $user, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'autocomplete' => "current-password"]])
                                        ->passwordInput()
                                        ->label()
                                ?>


                                <?= $form->field($user, 'rememberMe')->checkbox(['tabindex' => '3']) ?>



                            </div>
                        </div>
                    </div>
                    <!--</div>-->


                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <?php
                yii\widgets\ActiveForm::end();
                ?>

            </div>
        </div>
    </div>
</div>