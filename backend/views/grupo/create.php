<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Grupo */

$this->title = Yii::t('app', 'Create Grupo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
