<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
