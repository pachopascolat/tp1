<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Carrito */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrito-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php  
    $clientesArray = common\models\Cliente::find()->where(['agendado'=>true])->all();
    $clientes = yii\helpers\ArrayHelper::map($clientesArray, 'id_cliente', 'nombre_cliente');
    $vendedoresArray = \common\models\User::find()->all();
    $vendedores = yii\helpers\ArrayHelper::map($vendedoresArray, 'id', 'username');
    
    ?>
    
    <?= $form->field($model, 'cliente_id')->dropDownList($clientes) ?>
    <?= $form->field($model, 'vendedor_id')->dropDownList($vendedores) ?>
    <?= $form->field($model, 'observaciones')->textArea() ?>

    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
