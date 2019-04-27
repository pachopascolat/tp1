<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCarrito */

$this->title = Yii::t('app', 'Update Item Carrito: {name}', [
    'name' => $model->id_item_carrito,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Carritos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_item_carrito, 'url' => ['view', 'id' => $model->id_item_carrito]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="item-carrito-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
