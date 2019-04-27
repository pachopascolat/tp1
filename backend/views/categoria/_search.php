<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripción') ?>

    <?= $form->field($model, 'categoria_padre') ?>

    <?= $form->field($model, 'orden_categoria') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
