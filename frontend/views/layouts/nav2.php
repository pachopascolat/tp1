



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
                        <li class="nav-item <?= Yii::$app->user->isGuest?'d-none':'' ?>">
                            <a class="" href="<?= yii\helpers\Url::to(['sitio/crear-consulta']) ?>">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria','id_categoria'=> common\models\Categoria::NOVEDADES])?>">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="" href="#" data-toggle="modal" data-target="#pdf-report-modal">Catalogo</a>
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
                                <a href="#" class="text-white" data-toggle="modal" data-target="#login-modal">
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

<?= $this->render('_movil_iconos')?>
<?= $this->render('_modal_pdf')?>
<?= $this->render('_login_modal')?>



<div id="ayuda-modal" class="modal fade" role="dialog">
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