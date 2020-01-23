<style>
    a:hover h3, a:hover h5, .sidebar-menu a:hover{
        /*color: <?php // echo$_SESSION['categoria_padre']==1?'#ef6285':'#0074ab'         ?> !important*/
    }
</style>



<div class="nav2">


    <!--<img src="./imgHeader2/faja-02.jpg" class="nav2-img">-->
    <!--<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">-->
    <!--<div class="carousel-inner">-->
    <?php
    $hom = $_SESSION['categoria_padre'] ?? 1;
    $categorias = [null, "hogar", "moda"];
    $fajas = yii\helpers\FileHelper::findFiles(Yii::getAlias("@frontend") . "/web/img2020/" . $categorias[$hom] . "/");
//            foreach ($fajas as $key => $img):
    ?>
    <div class="">
        <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) . "/img2020/$categorias[$hom]/" . basename($fajas[0]) ?>" alt="First slide">
    </div>
    <?php // endforeach; ?>
    <!--            <div class="carousel-item">
                    <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/hogar/faja-02.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/hogar/faja-03.jpg" alt="Third slide">
                </div>-->
    <!--</div>-->
    <!--</div>-->

    <div class="absolute-div w-100 d-none d-md-block">
        <nav class="navbar">
            <div class="container">

                <div class="w-100 d-flex justify-content-end">
                    <ul class="navbar-nav navbar-expand">
                        <li class="nav-item">
                            <a class="" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria','id_categoria'=> common\models\Categoria::NOVEDADES])?>">Novedades</a>
                        </li>
<!--                        <li class="nav-item">
                            <a class="" href="#">Mis Consultas</a>
                        </li>-->
                        <li class="nav-item">
                            <a class="" href="#" data-toggle="modal" data-target="#ayuda-modal">Ayuda</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" data-target="#sucursales-dir" href="#">Sucursales</a>
                        </li>
                        <li class="nav-item navbar-icon-link">
                            <div class="">
                                <?php if (Yii::$app->user->isGuest) : ?>
                                <a class="text-white" data-toggle="modal" data-target="#login-modal">
                                        <i style="" class="fas fa-lock"></i>
                                        <span class="d-xs-block d-sm-none">Login</span>
                                    </a>

                                    <?php
                                else :
                                    echo \yii\helpers\Html::beginForm(['/user/logout'], 'POST', ['id' => 'logout-form']);
                                    ?>
                                    <a href="#" name="logout" class="" onclick="$('#logout-form').submit()">
                                        <span>Logout(<?= Yii::$app->user->identity->username ?>)</span>
                                    </a>
                                    <?php
                                    echo \yii\helpers\Html::endForm();
                                endif;
                                ?>
                            </div>






                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</div>

<div class="movil-iconos d-md-none pt-3" >
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-texsim-01.svg" alt="ketten">
                    </a>
                </div>

            </div>
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-blanco-01.svg" alt="ketten">
                    </a>
                </div>

            </div>
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-infantil.png" alt="ketten">
                    </a>
                </div>

            </div>
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-feria-01.svg" alt="ketten">

                    </a>
                </div>

            </div>
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-cortinas.png" alt="ketten">

                    </a>
                </div>

            </div>
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-vermas-01.svg" alt="ketten">

                    </a>
                </div>

            </div>
        </div>
        <div class="row ">
            <div class="col text-center text-nowrap">
                <span >Telas</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Sabaneria</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Infantil</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Moda</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Cortinas</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Ver mas</span>
            </div>
        </div>
    </div>
</div>


<div id="login-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php
            $user = Yii::createObject(dektrium\user\models\LoginForm::className());

//            echo  Html::beginForm(['/user/login'], 'post');
            $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'login-form',
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
<div id="ayuda-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h1 class="modal-title tex"></h1>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <iframe class="w-100" src="https://player.vimeo.com/video/329154106" 
                        width="480" 
                        height="360"
                        frameborder="0" 
                        title="Texsim" 
                        webkitallowfullscreen mozallowfullscreen allowfullscreen>

                </iframe>

            </div>


        </div>
    </div>
</div>
</div>