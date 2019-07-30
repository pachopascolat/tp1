<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaTelaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-tela-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_categoria_tela') ?>

    <?= $form->field($model, 'tela_id') ?>

    <?= $form->field($model, 'categoria_id') ?>

    <?= $form->field($model, 'orden') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
