<div id="modal-nuevo-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php
            $form = yii\widgets\ActiveForm::begin([
                        'id' => 'nuevo-item-form',
//                        'options' => [
//                            'data-pjax' => true,
//                            'data-pjax-push-state' => false,
//                            'data-pjax-replace-state' => false,
//                        ],
//                'pjax' => true,
//                'pjaxSettings' => [ 'options' => [ 'enablePushState' => false, ] ]
            ]);
            ?>
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?=
                $form->field($articuloSearch, 'tela_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Tela::find()->orderBy('orden_tela')->asArray()->all(), 'id_tela', 'nombre_tela'),
                    'options' => ['placeholder' => 'Choose Tela', 'class' => 'filters'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?=
                $form->field($articuloSearch, 'codigo_color')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Articulo::find()->filterWhere(['tela_id' => $articuloSearch->tela_id])->asArray()->all(), 'codigo_color', 'codigo_color'),
                    'options' => ['placeholder' => 'Choose Color', 'class' => 'filters'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
                <?php
                yii\widgets\Pjax::begin(['id' => 'items-pjax',
//                    'enablePushState' => false,
//                    'enableReplaceState'=>false,
                ]);
                ?>
                <script>

                </script>

                <?php
                $js = "
                    $('.items-todos-btn').click(function(){
                        $('#items-pjax .fa').addClass('selected');
                        $('#items-pjax input').prop('disabled',false);
                        $(this).hide();
                        $('.items-ninguno-btn').show();
                    });
                    $('.items-ninguno-btn').click(function(){
                        $('#items-pjax .fa').removeClass('selected');
                        $('#items-pjax input').prop('disabled',true);
                        $(this).hide();
                        $('.items-todos-btn').show();
                    });

                    $('#items-pjax .new-item-div').click(function () {
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
                    });";
                $this->registerJs($js);
                ?>



                <div class="d-flex">
<?php
foreach ($dataProvider->getModels() as $item):
    $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null, 100, 100);
    ?>
                                                                                                                        <!--<div data-id-item="<?= $item->id_articulo ?>" class="">-->
                        <div data-multiple=1 class="new-item-div">    
                            <input  type="texts" name="selectedItem[]" value="<?= $item->id_articulo ?>" disabled="disabled" class="new-item-checkbox d-none selectable">
                            <img class="w-100" src="<?= $url ?>">
                            <i   class="fa fa-check-circle fa-2x"></i>
                            <span class="image-name <?= $item->existencia?'':'text-danger'?>"><?= "$item->codigo_color $item->nombre_color" ?></span>
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
                <button data-id-vidriera="<?= $vidriera->id_vidriera ?>" type="button" class="btn btn-primary agregar-item-btn" name="agregarItem">Agregar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning items-todos-btn" >Seleccionar Todo</button>
                <button type="button" class="btn btn-info items-ninguno-btn" style="display: none" >Deseleccionar Todo</button>
            </div>
<?php $form = yii\widgets\ActiveForm::end(); ?>

        </div>
    </div>
</div>