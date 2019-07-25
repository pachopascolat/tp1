<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryImage */
/* @var $form yii\widgets\ActiveForm */
?>

<?php // echo  Html::img($model->getUrl('preview')) ?>
<?php
$url = yii\helpers\Url::to(['/galeria/update-galerias', 'tipo' => $model->galeria->tipo_galeria, 'tela_id' => $model->galeria->tela_id]);
$img = Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
$link = "<a data-pjax=0 target='_blank' href=$url  >$img</a>";
echo $link;
?>
<div class="gallery-image-form">


<?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'oferta')->checkbox(['maxlength' => true]) ?>
<?= $form->field($model, 'agotado')->checkbox(['maxlength' => true]) ?>


    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
