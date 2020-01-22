<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PdfReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pdf-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'timestamp_pdf')->textInput() ?>

    <?php //  $form->field($model, 'tela_id')->textInput() ?>

    <?php //  $form->field($model, 'user_id_pdf')->textInput() ?>

    <?php 
    $vidrieras = common\models\Vidriera::find()->joinWith('categoria')->where(['<>','nombre_categoria','PDF'])->all();
    $items = yii\helpers\ArrayHelper::map($vidrieras, 'id_vidriera', 'nombre');
    echo $form->field($model, 'vidriera_id')->dropDownList($items,['prompt'=>'Elegir Vidriera']);
    ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
