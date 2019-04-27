<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Modelo */

$this->title = Yii::t('app', 'Update Modelo: {name}', [
    'name' => $model->id_modelo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_modelo, 'url' => ['view', 'id' => $model->id_modelo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="modelo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
