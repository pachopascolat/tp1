<?php 
if ($model->liso != null && count($model->liso->disenios[0]->getBehavior('galleryBehavior')->getImages()) > 0): 
    ?>
    <div class="lisos-fixed" >
        <div class="container productos-fijos">
            <div class="barra-clasificacion"> <p>Lisos</p></div>  
            <div class="swiper-container swiper-lisos"  >
                <div class="swiper-wrapper" >      


                    <?php foreach ($model->liso->disenios[0]->getBehavior('galleryBehavior')->getImages() as $lisos) : ?>

                        <div class="swiper-slide">
                            <div class="product">
                                <div class="product-image">

                                     <?php
                                        $img = \common\models\GalleryImage::findOne($lisos->id);
                                        if ($img->agotado):
                                            ?>
                                            <img src="<?= Yii::getAlias("@web/img/agotado.svg") ?>" class="img-fluid img-agotado">
                                            <?php
                                        elseif ($img->oferta):
                                            ?>
                                            <img src="<?= Yii::getAlias("@web/img/oferta.svg") ?>" class="img-fluid img-agotado">

                                        <?php endif;
                                        ?>
                                    
                                    <img src="<?= $lisos->getUrl('preview') ?>" alt="product" class="swiper-lazy img-fluid"/>



                                    <div class="product-hover-overlay">
                                        <a  class="product-hover-overlay-link"></a>
                                        <div class="product-code-texsim text-light codigo-lisos">
                                            <p><?= $lisos->name ?></p>
                                        </div>
                                        <div class="product-hover-overlay-buttons-texsim">
                                            <a 
                                                href="" 
                                                data-target="#exampleModal-<?=$lisos->id?>"
                                                data-toggle="modal"
                                                class="zoom-texsim">

                                                <i class="fa fa-2x fa-search"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="swiper-lazy-preloader"></div>

                        </div>





                    <?php endforeach; ?>




                </div>
                <!-- If we need navigation buttons -->
                <!--                <div class="swiper-button-prev "></div>
                                <div class="swiper-button-next "></div>-->

            </div>  
        </div>
    </div>
<?php endif; ?>
