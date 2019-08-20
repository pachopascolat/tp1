<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PdfReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pdf-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'timestamp_pdf')->textInput() ?>

    <?= $form->field($model, 'tela_id')->textInput() ?>

    <?= $form->field($model, 'user_id_pdf')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
