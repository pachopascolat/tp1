<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Disenio */

$this->title = Yii::t('app', 'Update Disenio: {name}', [
    'name' => $model->id_disenio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disenios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_disenio, 'url' => ['view', 'id' => $model->id_disenio]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="disenio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
