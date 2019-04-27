<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCarrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-carrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'disenio_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
