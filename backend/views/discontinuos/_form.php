<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Discontinuos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="discontinuos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tela_id')->textInput() ?>

    <?php
    if ($model->isNewRecord) {
        echo 'Can not upload images for new record';
    } else {
        echo GalleryManager::widget(
                [
                    'model' => $model,
                    'behaviorName' => 'galleryBehavior',
                    'apiRoute' => 'discontinuos/galleryApi'
                ]
        );
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
