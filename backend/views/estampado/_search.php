<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EstampadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estampado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_estampado') ?>

    <?= $form->field($model, 'nombre_estampado') ?>

    <?= $form->field($model, 'columnas') ?>

    <?= $form->field($model, 'slides') ?>

    <?= $form->field($model, 'tela_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
