<style>
    a:hover h3, a:hover h5, .sidebar-menu a:hover{
        /*color: <?php // echo$_SESSION['categoria_padre']==1?'#ef6285':'#0074ab'?> !important*/
    }
</style>

<div class="nav2">

    <!--<img src="./imgHeader2/faja-02.jpg" class="nav2-img">-->
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $hom = $_SESSION['categoria_padre'] ?? 1;
            $categorias = [null, "hogar", "moda"];
            $fajas = yii\helpers\FileHelper::findFiles(Yii::getAlias("@frontend")."/web/img2020/" . $categorias[$hom]."/");
            foreach ($fajas as $key => $img):
                ?>
                <div class="carousel-item <?= $key==0?'active':''?>">
                    <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true)."/img2020/$categorias[$hom]/".basename($img)?>" alt="First slide">
                </div>
            <?php endforeach; ?>
<!--            <div class="carousel-item">
                <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/hogar/faja-02.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img alt="faja categoria" class="d-block w-100 nav2-img lazy" data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/hogar/faja-03.jpg" alt="Third slide">
            </div>-->
        </div>
    </div>

    <div class="absolute-div w-100">
        <nav class="navbar">
            <div class="container">
                <div id="sucursales-dir" class="collapse text-light w-100">
                    <a class="float-right">
                        <span class="">
                            Lavalle 2571 - 2120 0550 / Feria: Azcuenaga 580 - 2120 0580 / Feria: Olavarria 2348 Villa Celina - 6072 6831
                        </span>
                    </a>
                </div>
                <div class="w-100 d-flex justify-content-end">
                    <ul class="navbar-nav navbar-expand">
                        <li class="nav-item">
                            <a class="" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#">Mis Consultas</a>
                        </li>
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