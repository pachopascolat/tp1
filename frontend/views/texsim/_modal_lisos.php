<!--modal de cada liso-->
<?php if ($model->liso != null && !$model->liso->estaVacia()): ?>
    <?php foreach ($model->liso->getAllDisenios2() as $lisos) : ?>

        <div id="exampleModal-<?= $lisos->id ?>" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade quickview">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close modal-close">
                        <svg class="svg-icon w-100 h-100 svg-icon-light align-middle">
                        <use xlink:href="#close-1"> </use>
                        </svg>
                    </button>
                    <div class="modal-body">
                        <?php
                        $img = \common\models\GalleryImage::findOne($lisos->id);

                        ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="" data-slider-id="1" class="owl-carousel owl-theme owl-dots-modern detail-full owl">
                                    <div data-code="<?= $lisos->id ?>" id="modal-img<?= $lisos->id ?>" style="background: center center  url('<?= $lisos->getUrl('original') ?>') no-repeat; background-size: cover;" class="detail-full-item-modal"></div>
                                </div>
                                <h6 class="text-center" id="cant-modelos"></h6>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                                <div>
                                    <h3 id="" class="modal-disenio-codigo  mt-2 mt-lg-1 font-alt">
                                        <?= $lisos->name ." ".$lisos->description ?>
                                    </h3>
                                    <h2 id="" class="modal-tela-nombre mb-2  mt-lg-1 text-tiles">
                                        <?= $model->getNombreCompleto() ?>
                                    </h2>

                                    <p id="" class="modal-descripcion mb-4 text-muted">
                                        <?= $model->descripcion_larga_tela ?>                                                           
                                    </p>
                                    <form action="#">
                                        <input class="modal-disenio-id" name="id" value="<?= $lisos->id ?>" type="hidden"></input>
                                        <div class="row">

                                            <div class="col-12 detail-option mb-3">
                                                <label class="detail-option-heading font-weight-bold">Cantidad </label>
                                                <input name="cantidad" type="number" value="1" class="form-control detail-quantity">
                                            </div>
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">

                                                <button id="submit-consulta" type="button" class="submit-zoom btn btn-dark btn-lg mb-1">Consultar<i class="fa fa-chevron-right"></i></button>
                                            </li>

                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php endforeach; ?>
<?php endif; ?>
