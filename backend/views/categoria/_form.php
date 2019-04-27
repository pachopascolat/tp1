<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripción')->textarea(['rows' => 5]) ?>

    <?php
    $categorias = [1=>"Hogar",2=>"Moda"];
    $items = yii\helpers\ArrayHelper::map($categorias, 'id_categoria', 'nombre_categoria');
    ?>
    <?= $form->field($model, 'categoria_padre')->dropDownList($categorias) ?>

    <?php echo $form->field($model, 'orden_categoria')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
