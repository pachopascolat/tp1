<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Articulo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'toolbar' => [
            '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#import-stock">
                IMPORTAR STOCK
            </button>',
            '{export}', '{toggleData}'
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "Stock",
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_articulo',
            'codigo_color',
            'nombre_color',
//            'tela_id',
            [
                'attribute'=>'codigo_tela',
                'value' => 'tela.codigo_tela',
            ],
            [
                'attribute'=>'nombre_tela',
                'value' => 'tela.nombre_tela',
            ],
           
//            'tela.codigo_tela',
//            'tela.nombre_tela',
//            'codigo_color',
            'imagen_id',
            [
                'format' => 'raw',
                'value' => function($model) {
                    echo $this->render('_modal_imagen_form', ['model' => $model]);
                    $src = \Yii::$app->imagemanager->getImagePath($model->imagen_id, 50, 50);
                    $img = "<img src='" . $src . "'>";
                    if (!$src) {
                        $img = "cargar";
                    }
                    return "<a href='' data-toggle='modal' data-target='#cambiar-imagen-$model->id_articulo'>$img</a>";
                    
                }
            ],
//            [
//                'format' => 'raw',
//                'value' => function ($model) {
//                    $oldImage = $model->getOldImage();
//                    if ($oldImage) {
//                        $image = $oldImage->getUrl('preview');
//                    } else {
//                        $image = '';
//                    }
//                    /* @var $model  \common\models\Articulo */
//                    return "<img class='img-thumbnail' src=$image>";
//                }
//            ],
//            'imagen_id',
            'existencia',
            //'estado',
            //'nombre_articulo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
<div id="import-stock" class="modal" tabindex="-1" role="dialog">
    <?php $form = ActiveForm::begin(['action' => ['import'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Importar Stock</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="">
                        <!--<label class="form-control">Archivo Excel</label>--> 
                        <?= $form->field($searchModel, 'imageFile')->fileInput()->label("Stock") ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Importar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
