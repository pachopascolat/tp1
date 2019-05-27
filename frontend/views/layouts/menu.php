<?php
if ($categoria_padre == 1) {
    $hogar = "img/hogar-70x70.svg";
    $moda = "img/moda-70x70-hover-04.svg";
} else {
    $moda = "img/moda-70x70-01.svg";
    $hogar = "img/hogar-70x70-hover-03.svg";
}
?>

<style>




    .texto-banner{
        /*margin-left: -15px;*/
        height: 3.5em;
    }


    .navbar-icon-link-badge{
        width: 18px;
        height: 18px;
        line-height: 18px;
        top:-3px;
    }

    html,
    body{
        height: auto;
    }


    .sticky-nav {
        /*position: -webkit-sticky;*/   
        /*position: sticky ;*/
        /*top: 0;*/
        z-index: 50;
        width: 100%;
        /*height: 100%;*/
    }
    .navbar{
        padding-top: 0;
    }



    .tooltiptext {

        /*sombra*/
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);

        /*visibility: hidden;*/
        /*max-width: 140px;*/
        width: 160px;
        background-color: white;
        color: black;
        text-align: center;
        border-radius: 6px;
        padding: 20px;

        /* Position the tooltip */
        position: absolute;
        right: 0;
        z-index: 100;
    }
    .tooltiptext-notice{
        display: none;
    }
    .tooltiptext-link{
        visibility: hidden;
    }

    .texsim-tel{
        color: white !important;
        /*font-size: 1.5em;*/
    }
    .texsim-tel { pointer-events: none; }
    .texsim-tel > a { text-decoration:none; color:inherit; }


    @media (min-width:200px)  { 
        .texsim-tel{
            margin-right: 2.5px;
            font-size: 0.8em ;
        }
    }
    @media (min-width:365px)  { 
        .texsim-tel{
            margin-right: 5px;
            font-size: 1.1em ;
        }
    }
    @media (min-width:481px)  { 
        .texsim-tel{
            margin-right: 10px;
            font-size: 1.3em;
        }
    }
    @media (min-width:641px)  { 
        .texsim-tel{
            font-size: 1.5em;
        }
    }
    @media (min-width:961px)  { 
        .texsim-tel{
            font-size: 2em;
        }
    }

    .navbar-tel{
        display: flex;
        align-items: center;

    }




</style>
<header class="">
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Nosotros</h4>
                    <p class="text-muted">
                        Venta mayorista de rollos y de productos confeccionados con telas y diseños TEXSIM                                    </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#" class="text-white">
                        <h4 class="text-white">Contacto
                            <i style="" class="fab  fa-whatsapp"></i>
                        </h4>
                    </a>

                    <ul class="list-unstyled">
                        <!--<li><a href="#" class="text-white">Follow on Twitter</a></li>-->
                        <!--<li><a href="#" class="text-white">Like on Facebook</a></li>-->
                        <li><span  class="text-white">Lavalle 2571, C1052AAE CABA, Argentina</span></li>
                        <li>
                            <a  target="_blank" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#" class="text-white">
                                TEL: (54 11) 2120-0550  
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>




    <nav class="navbar navbar-dark bg-dark shadow-sm" >
        <div class="container d-flex justify-content-between">
            <div  class="navbar-brand d-flex align-items-center">
                <a class="hogar-link active" href="<?= yii\helpers\Url::to(['texsim/hogar']) ?>" style="max-width:72px">
                    <img  src="<?= $hogar ?>" class="responsive boton-hogar" style="width:72px" >
                </a>

                <a class="moda-link" href="<?= yii\helpers\Url::to(['texsim/moda']) ?>" style=" max-width:72px"> 
                    <img  src="<?= $moda ?>" class="responsive boton-moda" style="width:72px" >
                </a>

            </div>
            <div class="navbar-tel">
                <span class="texsim-tel ">TEL: (54 11) 2120-0550 </span>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

    </nav>


</header>
<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$categoria_padre == 1 ? $color = 'color-hogar' : $color = 'color-moda';
?>
<div class="sticky-nav" >
    <nav class="navbar   <?= $color ?>" >

        <!--<div class="container d-flex justify-content-between">-->
        <div class="container">


            <div class="iconos-barra">

                <div class="container-fluid">

                    <div class="d-flex align-items-center justify-content-between justify-content-lg-end my-lg-0">

                        <div class="">
                            <a href="<?= \yii\helpers\Url::to(['index']) ?>">
                                <img class="texto-banner" src="img/logotexsimdigital-home-franjanegra-01.svg">
                            </a>
                        </div>

                        <!-- Whastapp-->
                        <div class="nav-item navbar-icon-link">
                            <a target="_blanc" href="https://api.whatsapp.com/send?phone=541135386219&text=Me%20gustar%C3%ADa%20saber%20mas%20sobre%20sus%20productos.%20Gracias&source=&data=#" class="text-white">
                                <img class="svg-icon" src="img/txsim-header-whassap-01.svg" alt="whatsapp">
                                <!--<i style="font-size: 1.8em" class="fab fa-whatsapp"></i>-->
                                <!--(54 11) 35386219-->
                                <!--Iniciar Chat-->
                            </a>
                        </div>


                        <!-- Cart Dropdown-->
                        <?php
                        \yii\widgets\Pjax::begin(['id' => 'carrito-pjax', 'timeout' => false]);
                        if ($_SESSION['carrito'] != '') :
                            $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
                            if ($carrito->itemCarritos != null) :

//                            $items = \common\models\ItemCarrito::find()->where(['id_item_carrito'=>$_SESSION['carrito']])->all();
                                ?>

                                <div class="nav-item dropdown">
        <!--                                    <a href="<?= yii\helpers\Url::to(['crear-consulta', 'categoria_padre' => $categoria_padre]) ?>" class="navbar-icon-link d-lg-none"> 
                                        <img class="svg-icon " src="img/txsim-header-consulta-01.svg" alt="listado">
                                        <div class="navbar-icon-link-badge"><?= count($carrito->itemCarritos) ?></div>
                                    </a>-->
                                    <div class="navbar-icon-link2 carrito-link">

                                        <a  
                                            href="<?= yii\helpers\Url::to(['crear-consulta', 'categoria_padre' => $categoria_padre]) ?>" 
                                            class="navbar-icon-link ">

                                            <img class="svg-icon" src="img/txsim-header-consulta-01.svg" alt="listado">
                                            <div class="navbar-icon-link-badge"><?= count($carrito->itemCarritos) ?></div>

                                        </a>
                                        <div class="tooltiptext tooltiptext-link">
                                            Haga click aquí para ver su consulta
                                        </div>
                                        <div class="tooltiptext tooltiptext-notice">
                                            Su consulta se ha guardado aquí
                                        </div>

                                    </div>

                                </div>
                                <?php
                            endif;
                        endif;
                        ?>

                        <?php \yii\widgets\Pjax::end(); ?>
                        <!--Search Button-->
                        <div data-toggle="search" class="nav-item navbar-icon-link">
                            <!--<i style="color:white" class="fa fa-search"></i>-->
                            <img class="svg-icon" src="img/txsim-header-busqueda-01.svg" alt="buscar">


                        </div>

                        <div class="nav-item navbar-icon-link">
                            <?php if (Yii::$app->user->isGuest) { ?>
                                <div class=" text-white" data-toggle="modal" data-target="#login-modal">
                                    <i style="" class="fas fa-lock svg-icon "></i>
                                </div>
                                <?php
                            } else {
                                echo
                                Html::beginForm(['/user/logout'], 'post')
                                . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn text-white', 'name' => 'logout']
                                )
                                . Html::endForm();
                            }
                            ?>
                        </div>
                    </div>
                </div>


            </div>


        </div>







    </nav>
</div>
<div id="login-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $user = Yii::createObject(dektrium\user\models\LoginForm::className());

//            echo  Html::beginForm(['/user/login'], 'post');
            $form = ActiveForm::begin([
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
                                $form->field($user, 'login',
                                        ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                                );
                                ?>



                                <?=
                                        $form->field(
                                                $user,
                                                'password',
                                                ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
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

