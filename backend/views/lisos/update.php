<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lisos */

$this->title = Yii::t('app', 'Update Lisos: {name}', [
    'name' => $model->id_lisos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lisos, 'url' => ['view', 'id' => $model->id_lisos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
