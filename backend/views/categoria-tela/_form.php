<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoriaTela */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-tela-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $items = yii\helpers\ArrayHelper::map(common\models\Tela::find()->all(), 'id_tela', 'nombre_tela') ?>
    <?= $form->field($model, 'tela_id')->dropDownList($items) ?>


    <?php $items = yii\helpers\ArrayHelper::map(common\models\Categoria::find()->all(), 'id_categoria', 'nombre_categoria') ?>
    <?= $form->field($model, 'categoria_id')->dropDownList($items) ?>

    <?= $form->field($model, 'orden')->textInput(['type'=>'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
