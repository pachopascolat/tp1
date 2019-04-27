<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Disenio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disenio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_disenio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion_disenio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orden_disenio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tela_id')->textInput() ?>

    <?= $form->field($model, 'path_foto_disenio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
