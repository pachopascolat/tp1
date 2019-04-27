<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estampado */

$this->title = Yii::t('app', 'Create Estampado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estampados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estampado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
