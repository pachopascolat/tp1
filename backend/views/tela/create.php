<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tela */

$this->title = Yii::t('app', 'Create Tela');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Telas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tela-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoria_padre' => $categoria_padre,
    ]) ?>

</div>
