<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estampado */

$this->title = Yii::t('app', 'Update Estampado: {name}', [
    'name' => $model->id_estampado,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estampados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_estampado, 'url' => ['view', 'id' => $model->id_estampado]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="estampado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
