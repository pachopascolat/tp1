<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuit')->textInput() ?>

    <?= $form->field($model, 'nro_cliente')->textInput() ?>

    <?= $form->field($model, 'direccion_envio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agendado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
