<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GalleryImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diseños';
//$this->params['breadcrumbs'][] = $this->title;
?>



<div class="gallery-image-index">
    <?php
    $import = ' 
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#import-stock">
        IMPORTAR STOCK
    </button>';
    ?>
    <!--    <p>
    <?= Html::a('Create Gallery Image', ['create'], ['class' => 'btn btn-success']) ?>
        </p>-->

    <?php
    Pjax::begin(['id' => 'pjax-disenios']);

    $js = "
        $('.agotado').on('click',function () {
            var id = $(this).data('id-dis');
            $.ajax({
                url: 'toggle-agotado',
                data: {id: id},
                success: function () {
                    $.pjax.reload({container: '#pjax-disenios',timeout:1500});
                }
            })
        });
        $('.oferta').on('click',function () {
            var id = $(this).data('id-dis');
            $.ajax({
                url: 'toggle-oferta',
                data: {id: id},
                success: function () {
                    $.pjax.reload({container: '#pjax-disenios',timeout:1500});
                }
            })
        });
    ";
    $this->registerJs($js, View::POS_END);
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'toolbar' => [$import,
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
//             [
//        'class' => '\kartik\grid\CheckboxColumn'
//    ],
//            'id',
//            'galeria.tela_id',
            [
                'attribute' => 'codigo_tela',
                'value' => 'galeria.tela.codigo_tela'
            ],
            [
                'attribute' => 'nombre_tela',
                'value' => 'galeria.tela.nombre_tela'
            ],
//            'galeria.tela.codigo_tela',
//            [
//                'label' => 'nombreTela',
//                'value' => function($model) {
//                    return $model->getNombreTela();
//                }
//            ],
//            'ownerId',
//            [
//                'attribute'=>'ownerId',
//                'label'=>'Id Disenio',
//            ],
//            [
//                'label'=>'Nombre Tela',
//                'attribute'=>'nombreTela',
////                'value'=>function($model,$index){
////                    return $model->getTela()->nombre_tela;
////                }
//            ],
            'name',
            'description',
            [
                'label' => 'Imagen',
                'format' => 'html',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
                'value' => function($model) {
                    return Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                }
            ],
//            'type',
//            'ownerId',
//            'rank',
//            [
//                'class' => 'kartik\grid\EditableColumn',
//                'attribute' => 'oferta',
//                'editableOptions' => [
//                    'header' => 'Oferta',
//                    'inputType' => Editable::INPUT_CHECKBOX,
//                    'options' => ['pluginOptions' => ['min' => 0, 'max' => 1]]
//                ],
//                'hAlign' => 'right',
//                'vAlign' => 'middle',
//                'width' => '100px',
////                'format' => ['decimal', 2],
////                'pageSummary' => true
//            ],
            [
                'attribute' => 'agotado',
                'format' => 'raw',
                'value' => function($model, $index) {
                    $label = "Hay Stock";
                    $style = "success";
                    if ($model->agotado) {
                        $label = "Agotado";
                        $style = "danger";
                    }
                    return Html::a($label, null, ["data-pjax" => 0, "data-id-dis" => $index, 'class' => "agotado btn btn-$style"]);

//                    return Html::activeCheckbox($model, 'agotado[]', ['value' => $model->agotado, 'disabled' => false, 'label' => false]);
//                    echo Html::activeCheckbox($model, 'agotado');
                }
            ],
//            [
//                'attribute' => 'oferta',
//                'format' => 'raw',
//                'value' => function($model, $index) {
//                    $label = "Poner en Oferta";
//                    $style = "info";
//                    if ($model->oferta) {
//                        $label = "En Oferta";
//                        $style = "warning";
//                    }
//                    return Html::a($label, null, ["data-pjax" => 0, "data-id-dis" => $index, 'class' => "oferta btn btn-$style"]);
//
////                    return Html::activeCheckbox($model, 'agotado[]', ['value' => $model->agotado, 'disabled' => false, 'label' => false]);
////                    echo Html::activeCheckbox($model, 'agotado');
//                }
//            ],
            //'description:ntext',
            //'agotado',
            //'oferta',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

    <?php Pjax::end();
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
                        <?= $form->field($searchModel, 'imageFile')->fileInput() ?>
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