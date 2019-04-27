<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCarritoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-carrito-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_item_carrito') ?>

    <?= $form->field($model, 'disenio_id') ?>

    <?= $form->field($model, 'carrito_id') ?>

    <?= $form->field($model, 'cantidad') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
