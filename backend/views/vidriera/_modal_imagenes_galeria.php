<?php
$imagen = $imagenSearch;
$dataProvider = $dataProvider2;
?>
<div id="modal-imagenes-galeria" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <?php
            $form = yii\widgets\ActiveForm::begin([
                        'id' => 'galeria-form',
                        'action' => yii\helpers\Url::to(['cambiar-imagen'])
            ]);
            ?>
            <div class="modal-header">
                <h5 class="modal-title">Galeria Imagenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?=
                $form->field($imagen, 'globalSearch')->textInput(['class' => 'galery-filter form-control']);
                ?>

                <?php
                yii\widgets\Pjax::begin(['id' => 'galeria-pjax', 'enablePushState' => false]);
                $js = "
                   $('#galeria-pjax .new-item-div').click(function () {                       
                        var selected = $('#galeria-pjax .new-item-div .selected');
                        selected.removeClass('selected');
                        var input = $(this).find('input');
                        var tilde = input.siblings('.fa');
                        var estado = input.attr('disabled');
                        if (estado == 'disabled') {
                            tilde.addClass('selected');
                            input.prop('disabled', false);
                        } else {
                            tilde.removeClass('selected');
                            input.prop('disabled', true);
                        }
                    });     
 ";
                $this->registerJs($js);
                ?>

                <div class="d-flex">
                    <input  id="id-item" type="hidden" name="idItem" >
                    <?php
                    foreach ($dataProvider->getModels() as $item):
                        $url = Yii::$app->imagemanager->getImagePath($item->id ?? null, 100, 100);
                        ?>
                        <div class="new-item-div">
                            <?php // echo $form->field($articuloSearch, 'imagen_id')->textInput(['class' => 'd-none', 'disabled' => 'disabled'])->label(false) ?>
                            <input type="texts" name="imagenId" value="<?= $item->id ?>" disabled="disabled" class="d-none selectable">
                            <img class="w-100" src="<?= $url ?>">
                            <i   class="fa fa-check-circle fa-2x"></i>
                            <span class="image-name"><?= $item->fileName ?></span>
                            <!--</div>-->
                        </div>
                        <?php
                    endforeach;
                    ?>

                </div>
                <?php
                echo yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->getPagination(),
                ]);
                ?>
                <?php yii\widgets\Pjax::end() ?>
            </div>
            <div class="modal-footer">
                <button data-id-item="" type="button" class="btn btn-primary cambiar-imagen-btn" name="agregarItem">Cambiar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?php $form = yii\widgets\ActiveForm::end(); ?>

        </div>
    </div>
</div>