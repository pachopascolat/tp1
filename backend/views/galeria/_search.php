<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GaleriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galeria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_galeria') ?>

    <?= $form->field($model, 'nombre_galeria') ?>

    <?= $form->field($model, 'columnas') ?>

    <?= $form->field($model, 'slides') ?>

    <?= $form->field($model, 'tela_id') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <?php // echo $form->field($model, 'tipo_galeria') ?>

    <?php // echo $form->field($model, 'color_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
