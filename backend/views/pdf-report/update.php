<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PdfReport */

$this->title = 'Update Pdf Report: ' . $model->id_pdf_report;
$this->params['breadcrumbs'][] = ['label' => 'Pdf Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pdf_report, 'url' => ['view', 'id' => $model->id_pdf_report]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pdf-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
