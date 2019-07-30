<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaTela */

$this->title = 'Create Categoria Tela';
$this->params['breadcrumbs'][] = ['label' => 'Categoria Telas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-tela-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
