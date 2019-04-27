<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GalleryImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diseños';
//$this->params['breadcrumbs'][] = $this->title;
?>



<div class="gallery-image-index">


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
        'toolbar' => [
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
            
//            'id',
            'nombreTela',
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
            [
                'label' => 'Imagen',
                'format' => 'html',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
                'value' => function($model) {
                    return Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                }
            ],
            'type',
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
            [
                'attribute' => 'oferta',
                'format' => 'raw',
                'value' => function($model, $index) {
                    $label = "Poner en Oferta";
                    $style = "info";
                    if ($model->oferta) {
                        $label = "En Oferta";
                        $style = "warning";
                    }
                    return Html::a($label, null, ["data-pjax" => 0, "data-id-dis" => $index, 'class' => "oferta btn btn-$style"]);

//                    return Html::activeCheckbox($model, 'agotado[]', ['value' => $model->agotado, 'disabled' => false, 'label' => false]);
//                    echo Html::activeCheckbox($model, 'agotado');
                }
            ],
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
