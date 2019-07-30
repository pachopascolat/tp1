<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="tela-form">

    <?php $form = ActiveForm::begin(['action'=>['update','id'=>$model->id_tela]]); ?>

    <?php
    $telas = \common\models\Tela::find()->orderBy('nombre_tela')->all();
    $items = yii\helpers\ArrayHelper::map($telas, 'id_tela', 'nombre_tela');
    $items[null] = 'Sin Lisos';
//    array_push($items, 'Sin Lisos');
    ?>
    
    <?= $form->field($model, 'liso_id')->dropDownList($items,['prompt'=>'Elija un liso para combinar']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>