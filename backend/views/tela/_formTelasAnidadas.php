<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Tela */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tela-anidada-form col-sm-6">

    <?php 
    $form = ActiveForm::begin(['action' => ['agregar-hijo', 'id' => $model->id_tela]]); ?>

    <?php
    $telas = \common\models\Tela::find()->orderBy('nombre_tela')->all();
    $items = yii\helpers\ArrayHelper::map($telas, 'id_tela', 'nombre_tela');
//    echo Html::activeDropDownList($model, 'tela_hija', $items, ['class' => 'form-control']);
    echo $form->field($model, 'tela_hija')->dropDownList($items, ['prompt'=>'Seleccione Nueva Tela Hija','class' => 'form-control'])->label(false);
    ?>

    <div class="form-group">
        <?php // Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php echo Html::submitButton('Agregar', ['class' => 'btn btn-primary']); ?>

    </div>

    <?php ActiveForm::end(); ?>
    <h3>Telas Hijas</h3>
    <table class="table table-condensed table-bordered">
        <thead>
        <th>Codigo</th>
        <th>Tela</th>
        <th>Accion</th>
        </thead>
        <tbody>
            <?php foreach ($model->telasHijas as $tela_hija): ?>
                <tr>
                    <td class=""><?php echo $tela_hija->telaHija->codigo_tela ?></td>
                    <td class=""><?php echo $tela_hija->telaHija->nombre_tela ?></td>
                    <td class="text-center align-content-center"><?= Html::a('Borrar', ['delete-hijo', 'id' => $tela_hija->id_tela_anidada], ['class' => 'btn btn-danger btn-sm']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
