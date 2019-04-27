<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Estampado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estampado-form">

    <?= Html::a(Yii::t('app', 'ver en Frontend'), Yii::$app->urlManagerFrontEnd->createUrl(['estampados', 'id' => $model->tela->id_tela]), ['class' => 'btn btn-primary', 'target' => '_blank']) ?>

    <?php
    yii\widgets\Pjax::begin(['id' => 'pjax_widget_id']);

    $form = ActiveForm::begin(['id' => 'grupoform']);
    ?>

    <?php // echo $form->field($model, 'nombre_estampado')->textInput(['maxlength' => true])  ?>

    <?= $form->field($model, 'columnas')->textInput(['type' => 'number', 'class' => 'columnas-input']) ?>

    <?php // echo $form->field($model, 'slides')->textInput(['type' => 'number', 'class' => 'columnas-input']) ?>

    <?php // echo  $form->field($model, 'tela_id')->textInput()  ?>
    <div id="my-widget" class="" style="width: <?= (150 * $model->columnas); ?>px ">

        <?php
        if ($model->isNewRecord) {
            echo 'Can not upload images for new record';
        } else {
            echo GalleryManager::widget(
                    [
//                            'buttons' => $buttons,
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'estampado/galleryApi'
                    ]
            );
        }
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end();

    yii\widgets\Pjax::end();
    ?>

</div>
<?php
$js = "
    $('.columnas-input').change(function () {
        options = {
        type: 'POST',
                url: $('#grupoform').attr('action'),
                container: '#pjax_widget_id',
                data: $('#grupoform').serialize(),
        };
                $.pjax.reload(options);
        });

    $(document).on('ready pjax:success', function () {
        $('.columnas-input').change(function () {
        options = {
        type: 'POST',
                url: $('#grupoform').attr('action'),
                container: '#pjax_widget_id',
                data: $('form').serialize(),
        };
                $.pjax.reload(options);
        });
        });
        ";

$this->registerJs($js);
?>