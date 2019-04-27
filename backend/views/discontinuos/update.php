<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Discontinuos */

$this->title = Yii::t('app', 'Update Discontinuos: {name}', [
    'name' => $model->id_discontinuos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discontinuos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_discontinuos, 'url' => ['view', 'id' => $model->id_discontinuos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="discontinuos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
