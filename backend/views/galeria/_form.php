<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Galeria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galeria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_galeria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'columnas')->textInput() ?>

    <?= $form->field($model, 'slides')->textInput() ?>

    <?= $form->field($model, 'tela_id')->textInput() ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <?= $form->field($model, 'tipo_galeria')->textInput() ?>

    <?= $form->field($model, 'color_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
