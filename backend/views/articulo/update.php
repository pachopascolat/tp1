<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Articulo */

$this->title = 'Update Articulo: ' . $model->id_articulo;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_articulo, 'url' => ['view', 'id' => $model->id_articulo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
