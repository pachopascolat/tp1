<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Disenio */

$this->title = Yii::t('app', 'Create Disenio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disenios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disenio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
