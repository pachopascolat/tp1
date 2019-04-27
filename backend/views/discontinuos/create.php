<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Discontinuos */

$this->title = Yii::t('app', 'Create Discontinuos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discontinuos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discontinuos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
