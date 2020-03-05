<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'nombre_cliente') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'mail_cliente') ?>

    <?= $form->field($model, 'cuit') ?>

    <?php // echo $form->field($model, 'nro_cliente') ?>

    <?php // echo $form->field($model, 'direccion_envio') ?>

    <?php // echo $form->field($model, 'agendado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
