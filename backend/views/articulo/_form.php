<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Articulo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tela_id')->textInput() ?>

    <?= $form->field($model, 'codigo_color')->textInput() ?>

    <?= $form->field($model, 'imagen_id')->textInput() ?>

    <?= $form->field($model, 'existencia')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'nombre_articulo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
