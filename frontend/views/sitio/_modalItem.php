<div class="modal-item-div">
<?php foreach ($items as $item): ?>
    <?php if ($item): ?>
        <?php 
        $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null) 
                ?>

        <div id="item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="modal p-3" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <!--<div class="modal-header">-->
                    <!--<h5 class="modal-title">Modal title</h5>-->

                    <!--</div>-->
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close modal-close">
                        <div class="d-flex align-items-center w-100 justify-content-center">
                            <i class="fal fa-times fa-2x"></i>
                        </div>
                    </button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 p-0">
                                <div class="d-flex justify-content-center">
                                    <img class="img-modal-item img-fluid w-100 lazy_load" data-src="<?= $url ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center pl-lg-5 text-center text-lg-left">
                                <div class="w-100">
                                    <h3 id="" class="modal-disenio-codigo  mt-2 mt-lg-1 title">

                                        <?= "{$item->articulo->codigo_color} {$item->articulo->nombre_color} " ?>
                                    </h3>
                                    <h2 id="" class="modal-tela-nombre mb-2  mt-lg-1 text-tiles title">
                                        <?= $item->articulo->tela->nombre_tela ?>
                                    </h2>

                                    <p id="" class="modal-descripcion mb-md-4 text-muted title">
                                        <?= $item->articulo->tela->descripcion_larga_tela ?>

                                    </p>
                                    <form action="#">
                                        <input class="modal-disenio-id" name="id" value="<?= $item->id_item_vidriera ?>" type="hidden">
                                        <div class="">

                                            <div class=" mb-3 d-flex d-lg-block justify-content-center align-items-center">
                                                <label class="title detail-option-heading font-weight-bold mb-0 pr-3 pt-1 pb-1">Cantidad </label>
                                                <input name="cantidad" type="number" value="1" class="modal-cantidad form-control detail-quantity">
                                            </div>
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button data-pjax="false" type="button" class="title submit-zoom btn btn-dark btn-lg mb-1"> Consultar<i class="fa fa-chevron-right"></i></button>
                                            </li>

                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>-->
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>
<script>

</script>

