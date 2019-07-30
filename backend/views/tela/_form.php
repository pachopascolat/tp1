<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Tela */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tela-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <?php
    $categorias = \common\models\Categoria::find()->all();
    $items = yii\helpers\ArrayHelper::map($categorias, 'id_categoria', 'nombre_categoria');
    ?>
    <?php
    foreach ($categorias as $category) {
        $checked = false;
        foreach ($model->categorias as $catTela) {
            if ($category->id_categoria == $catTela->categoria_id) {
                $checked = true;
            }
        }
        echo "<div style='float:left;margin-left:1em'>";
//        echo $form->field($model, 'categorys[]')->checkbox(['label'=>$category->nombre_categoria,'value'=>$category->id_categoria,'checked'=>$checked]);
        echo Html::checkbox('Tela[categorys][]', $checked, ['label' => $category->nombre_categoria, 'value' => $category->id_categoria, 'checked' => $checked]);
        echo "</div>";
    }
    ?>
    <div class="clearfix"> </div>

<?= $form->field($model, 'nombre_tela')->textInput(['maxlength' => true]) ?>
    <?php // echo $form->field($model, 'descripcion_tela')->textInput(['maxlength' => true])   ?>
    <?= $form->field($model, 'descripcion_larga_tela')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'codigo_tela')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'orden_tela')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ocultar')->checkbox() ?>



<?php
//    if ($model->isNewRecord) {
//        echo 'Can not upload images for new record';
//    } else {
//        echo GalleryManager::widget(
//                [
//                    'model' => $model,
//                    'behaviorName' => 'galleryBehavior',
//                    'apiRoute' => 'tela/galleryApi'
//                ]
//        );
//    }
?>


    <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
