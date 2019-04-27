<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carrito */

$this->title = Yii::t('app', 'Update Carrito: {name}', [
    'name' => $model->id_carrito,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_carrito, 'url' => ['view', 'id' => $model->id_carrito]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="carrito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
