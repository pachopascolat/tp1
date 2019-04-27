<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DisenioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disenio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_disenio') ?>

    <?= $form->field($model, 'nombre_disenio') ?>

    <?= $form->field($model, 'descripcion_disenio') ?>

    <?= $form->field($model, 'orden_disenio') ?>

    <?= $form->field($model, 'tela_id') ?>

    <?php // echo $form->field($model, 'path_foto_disenio') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
