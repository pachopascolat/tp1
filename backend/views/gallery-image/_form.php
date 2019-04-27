<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-image-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'oferta')->checkbox(['maxlength' => true]) ?>
        <?= $form->field($model, 'agotado')->checkbox(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
