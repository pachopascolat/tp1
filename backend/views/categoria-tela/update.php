<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaTela */

$this->title = 'Update Categoria Tela: ' . $model->id_categoria_tela;
$this->params['breadcrumbs'][] = ['label' => 'Categoria Telas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_categoria_tela, 'url' => ['view', 'id' => $model->id_categoria_tela]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoria-tela-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
