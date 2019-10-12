<?php
$dis = $design;
//foreach ($model->getSliders() as $key => $galeria):
//    foreach ($galeria as $index => $dis):
?>

<div data-id="<?= $dis->id ?>"  id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal-disenios modal fade quickview">
<?php \yii\widgets\Pjax::begin(['id' => 'pjax-modal-todos']); ?>
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" data-dismiss="modal" aria-label="Close" class="close modal-close">
                <svg class="svg-icon w-100 h-100 svg-icon-light align-middle">
                <use xlink:href="#close-1"> </use>
                </svg>
            </button>
            <div class="modal-body"> 

<?php
$img = $dis;
?>
        <!--                        <div class="ribbon ribbon-agotado <?php // echo !$img->agotado? "d-none":"" ?>">
            Agotado
        </div>
        <div class="ribbon ribbon-oferta <?php // echo !$img->oferta? "d-none":""  ?>">
            Oferta
        </div>-->

                <div class="row">
                    <div class="col-lg-6">
                        <div id="modelos-slider<?= $dis->id ?>" data-slider-id="<?= $dis->id ?>" class="owl-carousel owl-theme owl-dots-modern detail-full owl">
                            <div id="modelo-<?= $dis->id ?>" 
                                 data-nombre="<?= $dis->description ?>" 
                                 data-id="<?= $dis->id ?>" 
                                 data-code="<?= $dis->name ?>" 
                                 id="modal-img<?= $dis->id ?>" 
                                 style="background: center center  url('<?= $dis->getUrl('original') ?>') no-repeat; background-size: cover;" 
                                 class="detail-full-item-modal">
                            </div>
<?= $this->render('_modelos_div', ['disenio' => $img]) ?>
                        </div>
                        <h6 class="text-center cant-modelos" id="cant-modelos-<?= $dis->id ?>"></h6>

                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div>
                            <h3 id="" class="modal-disenio-codigo  mt-2 mt-lg-1 font-alt">
<?= $dis->name . " " . $dis->description ?>
                            </h3>
                            <h2 id="" class="modal-tela-nombre mb-2  mt-lg-1 text-tiles">
<?= $img->tela->nombre_tela ?? '' ?>
                            </h2>

                            <p id="" class="modal-descripcion mb-4 text-muted">
<?= $img->tela->descripcion_larga_tela ?? '' ?>                                                           
                            </p>
                            <form action="#">
                                <input class="modal-disenio-id" name="id" value="<?= $dis->id ?>" type="hidden"></input>
                                <div class="row">

                                    <div class="col-12 detail-option mb-3">
                                        <label class="detail-option-heading font-weight-bold">Cantidad </label>
                                        <input name="cantidad" type="number" value="1" class="modal-cantidad form-control detail-quantity">
                                    </div>
                                </div>
                                <ul class="list-inline">
                                    <li class="list-inline-item">

                                        <button data-pjax="false"  type="button" class="submit-zoom btn btn-dark btn-lg mb-1"> Consultar<i class="fa fa-chevron-right"></i></button>
                                    </li>

                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php \yii\widgets\Pjax::end(); ?>
</div>

<?php // endforeach;  ?>
<?php // endforeach;  ?>
