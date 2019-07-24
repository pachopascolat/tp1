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
            <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to([$menus[$model->categoria->categoria_padre]]) ?>"><?= $menus[$model->categoria->categoria_padre] ?></a></li>
            <li class="breadcrumb-item active"><?= $model->getNombreCompleto() ?>        </li>
        </ol>
        <?php
        $form = \yii\bootstrap4\ActiveForm::begin(['id'=>'filtro-telas']);
        $telas = \common\models\Tela::find()->orderBy('nombre_tela')->all();
        $items = \yii\helpers\ArrayHelper::map($telas, 'id_tela', 'nombre_tela');
        ?>
        <div class="d-flex align-items-center">
                <?= $form->field($model, 'id_tela')->dropdownList($items, [
                    'class' => 'form-control m-1',
                    'onchange'=> 'filtrar()'
                    ])->label(false); ?>

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




        <?php 
        foreach ($model->disenios as $key => $estampado): ?>
            <?php
            $ordenados = $estampado->ordenar();
            ?>                        
            <div class="swiper-container swiper<?= $key ?>">

                <div class="swiper-wrapper">
                    <?php
                    foreach ($ordenados as $index => $dis):
                        $img = \common\models\GalleryImage::findOne($dis->id);
                        if ($dis == null) {
                            echo '<div class="swiper-slide"></div>';
                        } 
                        else if($img->agotado){
                            
                        }
                        else {
                            ?>   
                            <div class="swiper-slide">
                                <div class="product">
                                    <div class="product-image">
                                        <?php
                                        $img = \common\models\GalleryImage::findOne($dis->id);
                                        if ($img->agotado):
                                            ?>
                                            <img src="<?= Yii::getAlias("@web/img/agotado.svg") ?>" class="img-fluid img-agotado">
                                            <?php
                                        elseif ($img->oferta):
                                            ?>
                                            <img src="<?= Yii::getAlias("@web/img/oferta.svg") ?>" class="img-fluid img-agotado">

                                        <?php endif;
                                        ?>
                                        <img data-src='<?= $dis->getUrl('preview') ?>' class="swiper-lazy img-fluid">
                                        <div class="swiper-lazy-preloader" style="margin-top: 10px"></div>
                                        <div class="product-hover-overlay"><a  class="product-hover-overlay-link"></a>
                                            <div class="product-code-texsim text-light ">
                                                <p><?= $dis->name ?></p>
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
        <?php
        if ($model->discontinuos != null && count($model->discontinuos->getBehavior('galleryBehavior')->getImages()) > 0):
            ?>
            <div class="barra-clasificacion"> <p>Discontinuos</p></div>  
            <div class="swiper-container swiper1">
                <div class="swiper-wrapper">      
                    <?php foreach ($model->discontinuos->getBehavior('galleryBehavior')->getImages() as $discontinuo) : ?>
                        <div class="swiper-slide">
                            <div class="product">
                                <div class="product-image">
                                    <img  src="<?= $discontinuo->getUrl('preview') ?>" alt="product" class="swiper-lazy img-fluid"/>
                                    <div class="product-hover-overlay"><a  class="product-hover-overlay-link"></a>
                                        <div class="product-hover-overlay-buttons-texsim">
                                            <!--                                                    <a href="#" class="btn btn-outline-light btn-product-left">
                                                                                                    <i class="fa fa-check"></i>
                                                                                                </a>-->
                                            <!--                                                    <a  class="btn btn-dark btn-buy">
                                                                                                    <i class="fa-search fa"></i>
                                                                                                    <span class="btn-buy-label ml-2">View</span>
                                                                                                </a>-->
                                            <a data-image="<?= $discontinuo->getUrl('original') ?>" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-modal">
                                                <!--<i class="fa fa-expand-arrows-alt"></i>-->
                                                <i class="fa fa-2x fa-search"></i>
                                            </a>

                                        </div>
                                        <div class="product-code text-light "><p><?= $discontinuo->name ?></p></div>
                                    </div>
                                    <div class="swiper-lazy-preloader"></div>
                                </div>

                            </div>

                        </div> 
                    <?php endforeach; ?>
                </div> 
            </div>

            <div class="shadow-swiper-container"></div>  

        <?php endif; ?>










    </div>



</div>

<?= $this->render('_lisos', ['model' => $model]); ?>   









<?= $this->render('_modal_lisos', ['model' => $model]); ?>   

<?= $this->render('_modal_estampados', ['model' => $model]); ?>   






<?= $this->render('/layouts/footer'); ?>

<?= $this->render('_scripts', ['model' => $model]); ?>   



