<?php

use frontend\assets\AppAsset;

//AppAsset::register($this);
$menus = [null, "hogar", "moda"];
?>



<?= $this->render('/layouts/menu', ['categoria_padre' => $categoria_padre]); ?>   


<?= $this->render('_estilos', ['categoria_padre' => $categoria_padre]); ?>   






<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-left">
            <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
            <!--<li class="breadcrumb-item"><a href="<?php // echo yii\helpers\Url::to([$menus[$model->categoria->categoria_padre??'']])             ?>"><?php // echo $menus[$model->categoria->categoria_padre??'']             ?></a></li>-->
            <li class="breadcrumb-item active"><?= $model->getNombreCompleto() ?>        </li>
        </ol>
        <?php
        $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'filtro-telas']);
        $telas = \common\models\Tela::getTelasLlenas();
        $items = \yii\helpers\ArrayHelper::map($telas, 'id_tela', 'nombre_tela');
        ?>
        <div class="d-flex justify-content-between">
            <?=
            $form->field($model, 'id_tela')->dropdownList($items, [
                'class' => 'form-control p-0 filtrar-telas',
//                'onchange' => 'filtrar()'
            ])->label(false);
            ?>
            <?php if (Yii::$app->user->can('gestionarCarrito')): ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdf-modal">
                    PDF
                </button>
            <?php endif; ?>

        </div>





        <?php \yii\bootstrap4\ActiveForm::end(); ?>

        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading"><?= $model->getNombreCompleto() ?></h1>
            <!--<div class="row">   
              <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
            </div>-->
        </div>
    </div>
</section>


<div class="album py-5 ">
    <div class="container">




        <?php foreach ($model->getSliders() as $key => $galeria): ?>
            <?php
//            $ordenados = $estampado->ordenar();
            ?>                        
            <div class="swiper-container swiper<?= $key ?>">

                <div class="swiper-wrapper">
                    <?php
                    foreach ($galeria as $index => $img):
                        $dis = $img;
//                        if ($dis) {
//                            $img = \common\models\GalleryImage::findOne($dis->id);
//                        }
                        if ($img == null) {
                            echo '<div class="swiper-slide"></div>';
                        } else {
                            ?>   
                            <div class="swiper-slide">
                                <div class="product">
                                    <div class="product-image">
                                        <?php
//                                        $img = \common\models\GalleryImage::findOne($dis->id);
//                                        if ($img->agotado):
                                        ?>
                                            <!--<img src="<?= Yii::getAlias("@web/img/agotado.svg") ?>" class="img-fluid img-agotado">-->
                                        <?php
//                                        elseif ($img->oferta):
                                        ?>
                                            <!--<img src="<?= Yii::getAlias("@web/img/oferta.svg") ?>" class="img-fluid img-agotado">-->

                                        <?php // endif;
                                        ?>
                                        <img  data-srcset='<?= $dis->getUrl('preview') ?>' class="swiper-lazy img-fluid">
<!--                                        <div class="swiper-lazy-preloader" style="margin-top: 10px">

                                        </div>-->
                                        <?php if ($dis->tieneModelos()): ?>
                                            <a 
                                                href=""
                                                data-target="#exampleModal-<?= $dis->id ?>"
                                                data-toggle="modal"
                                                class="text-light vermas">
                                                VER +
                                                 <!--<i class="fa fa-expand-arrows-alt"></i>-->
                                                <!--<i class="fa fa-2x fa-plus-circle"></i>-->
                                            </a>
                                        <?php endif; ?>
                                        <div class="product-hover-overlay"><a  class="product-hover-overlay-link"></a>
                                            <div class="product-code-texsim text-light ">
                                                <p><?= $dis->description ?></p>
                                            </div>
                                            <div class="product-hover-overlay-buttons-texsim">                        

                                                <a 
                                                    href=""
                                                    data-target="#exampleModal-<?= $dis->id ?>"
                                                    data-toggle="modal"
                                                    class="modal-btn zoom-texsim">
                                                     <!--<i class="fa fa-expand-arrows-alt"></i>-->
                                                    <i class="fa fa-2x fa-search"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="swiper-lazy-preloader mt-auto"></div>

                            </div>

                            <?php
                        }
                    endforeach;
                    ?>

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev "></div>
                <div class="swiper-button-next "></div>

                <!-- If we need scrollbar -->
                <!--<div class="swiper-scrollbar"></div>-->

            </div>

        <?php endforeach; ?>






        <div class="shadow-swiper-container"></div> 


    </div>



</div>

<?= $this->render('_lisos', ['model' => $model]); ?>   









<?php echo $this->render('_modal_lisos', ['model' => $model]); ?>   

<?= $this->render('_modal_estampados_1', ['model' => $model]); ?>   



<div id="pdf-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Descargar PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php
                    $pdfs = \common\models\PdfReport::find()->where(['tela_id' => $model->id_tela])->all();
                    foreach ($pdfs as $pdf):
                        ?>
                        <li class="list-group-item text-center">
                            <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['descargar-pdf', 'id' => $pdf->id_pdf_report]) ?>">
                                <?= $pdf->nombre_pdf ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






<?= $this->render('/layouts/footer'); ?>

<?= $this->render('_scripts_1', ['model' => $model]); ?>   



