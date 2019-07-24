<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Galeria */

$this->title = 'Update Galeria: ' . $model->id_galeria;
$this->params['breadcrumbs'][] = ['label' => 'Galerias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_galeria, 'url' => ['view', 'id' => $model->id_galeria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="galeria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
