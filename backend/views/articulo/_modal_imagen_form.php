<?php

use yii\widgets\ActiveForm;
?>
<div id="cambiar-imagen-<?= $model->id_articulo ?>" class="modal" tabindex="-1" role="dialog">
    <?php $form = ActiveForm::begin(['id' => 'image-form-' . $model->id_articulo, 'action' => ['update-image', 'id' => $model->id_articulo]]) ?>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="modal-title">Cambiar Imagen</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo $form->field($model, "[$model->id_articulo]imagen_id")->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
//                            'aspectRatio' => (16 / 9), //set the aspect ratio
                    'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
                    'showPreview' => true, //false to hide the preview
                    'showDeletePickedImageConfirm' => false, //on true show warning before detach image
                    'options' => [
                        'name' => "imagen$model->id_articulo"]
                ]);
                ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>