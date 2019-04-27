<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryImageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-image-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'ownerId') ?>

    <?= $form->field($model, 'rank') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'agotado') ?>

    <?php // echo $form->field($model, 'oferta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
