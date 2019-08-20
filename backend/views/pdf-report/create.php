<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PdfReport */

$this->title = 'Create Pdf Report';
$this->params['breadcrumbs'][] = ['label' => 'Pdf Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pdf-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
