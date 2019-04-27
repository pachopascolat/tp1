<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Grupo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php
    $items = yii\helpers\ArrayHelper::map(\common\models\Tela::find()->all(), 'id_tela', 'nombre_tela');
    ?>
    
    <?= $form->field($model, 'tela_id')->dropDownList($items) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
