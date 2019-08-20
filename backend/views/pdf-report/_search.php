<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PdfReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pdf-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pdf_report') ?>

    <?= $form->field($model, 'timestamp_pdf') ?>

    <?= $form->field($model, 'tela_id') ?>

    <?= $form->field($model, 'user_id_pdf') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
