<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Grupo */

$this->title = Yii::t('app', 'Update Grupo: {name}', [
    'name' => $model->id_grupo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo, 'url' => ['view', 'id' => $model->id_grupo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
