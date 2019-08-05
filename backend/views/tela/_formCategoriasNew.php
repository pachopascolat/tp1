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
    $form = ActiveForm::begin(['action' => ['agregar-categoria', 'id' => $model->id_tela]]); ?>

    <?php
    $categorias = \common\models\Categoria::find()->orderBy('nombre_categoria')->all();
    foreach ($categorias as $categoria){
        $categoria->parent_category = $categoria->getParentCategory();
    }
    $items = yii\helpers\ArrayHelper::map($categorias, 'id_categoria', 'parent_category');
//    echo Html::activeDropDownList($model, 'tela_hija', $items, ['class' => 'form-control']);
    echo $form->field($model, 'category')->dropDownList($items, ['prompt'=>'Seleccione Nueva Categoria','class' => 'form-control'])->label(false);
    ?>

    <div class="form-group">
        <?php // Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php echo Html::submitButton('Agregar', ['class' => 'btn btn-primary']); ?>

    </div>

    <?php ActiveForm::end(); ?>
    <h3>Categorias</h3>
    <table class="table table-condensed table-bordered">
        <thead>
        <!--<th>Codigo</th>-->
        <th>Categoria</th>
        <th>Orden</th>
        <th>Accion</th>
        </thead>
        <tbody>
            <?php foreach ($model->categorias as $categoria): ?>
                <tr>
                    <td class=""><?php echo $categoria->categoria->nombre_categoria ?></td>
                    <td class=""><?php echo $categoria->orden ?></td>
                    <td class="text-center align-content-center"><?= Html::a('Editar', ['/categoria-tela/update', 'id' => $categoria->id_categoria_tela], ['class' => 'btn btn-warning btn-sm']) ?></td>
                    <td class="text-center align-content-center"><?= Html::a('Borrar', ['delete-categoria', 'id' => $categoria->id_categoria_tela], ['class' => 'btn btn-danger btn-sm']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
