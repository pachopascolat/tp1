<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vidriera */

$this->title = 'Update Vidriera: ' . ' ' . $model->id_vidriera;
$this->params['breadcrumbs'][] = ['label' => 'Vidriera', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_vidriera, 'url' => ['view', 'id' => $model->id_vidriera]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vidriera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
