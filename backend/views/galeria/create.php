<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Galeria */

$this->title = 'Create Galeria';
$this->params['breadcrumbs'][] = ['label' => 'Galerias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
