<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lisos */

$this->title = Yii::t('app', 'Create Lisos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lisos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lisos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
