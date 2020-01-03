<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VidrieraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-vidriera-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_vidriera')->textInput(['placeholder' => 'Id Vidriera']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Nombre']) ?>

    <?= $form->field($model, 'estado')->textInput(['placeholder' => 'Estado']) ?>

    <?= $form->field($model, 'categoria_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Categoria::find()->orderBy('id_categoria')->asArray()->all(), 'id_categoria', 'id_categoria'),
        'options' => ['placeholder' => 'Choose Categoria'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'orden_vidriera')->textInput(['placeholder' => 'Orden Vidriera']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
