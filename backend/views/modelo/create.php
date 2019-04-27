<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Modelo */

$this->title = Yii::t('app', 'Create Modelo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modelo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
