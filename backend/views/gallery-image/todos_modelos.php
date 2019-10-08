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



<div class="gallery-image-index-models">
  
    <?php

    $js = "
        

        $(document).on('pjax:end', function() {
            $('.img-thumbnail').each(function(){
                        var src = $(this).attr('src')+'?hola';
                        $(this).attr('src',src);
                    });
        });
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
        $('.estado').on('click',function () {
            var id = $(this).data('id-dis');
            $.ajax({
                url: 'toggle-estado',
                data: {id: id},
                success: function () {
                    $.pjax.reload({container: '#pjax-disenios',timeout:1500});
                }
            })
        });
        $('.hacer-padre').on('click',function () {
            var id = $(this).data('id-dis');
            $.ajax({
                url: 'convertir-padre',
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
//    $this->registerJs($js, View::POS_END);
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'toolbar' => [
//            count($sinCargar) > 0 ? Html::button('Sin Cargar', ['class' => 'btn btn-default', 'data-toggle' => "modal", 'data-target' => "#sin-cargar"]) : '',
//            $importDif,
//            $import,
            '{export}', '{toggleData}'
        ],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => "Stock",
        ],
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//             [
//        'class' => '\kartik\grid\CheckboxColumn'
//    ],
//            'id',
//            'ownerId',
//            'galeria.id_galeria',
//            'galeria.color_id',
//            [
//                'attribute' => 'tipo_galeria',
//                'value' => function($model) {
//                    if ($model->galeria->tipo_galeria == 1) {
//                        return "Diseño";
//                    } else {
//                        return "Modelo";
//                    }
//                }
//            ],
            
            [
                'attribute' => 'codigo_tela',
                'value' => 'galeria.tela.codigo_tela'
            ],
            [
                'attribute' => 'nombre_tela',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->galeria->tela->nombre_tela, Yii::$app->urlManagerFrontEnd->createUrl(['designs', 'id' => $model->galeria->tela_id]), ['data-pjax' => 0, 'target' => '_blank']);
                }
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
                'format' => 'raw',
                'value' => function($model, $index) {
                    if ($model->galeria->tipo_galeria == 3) {
                        return Html::a('hacer Principal', null, ["data-id-dis" => $index, 'data-pjax' => 0, 'class' => ['btn btn-sx btn-info hacer-padre']]);
                    } else {
                        return "";
                    }
                }
            ],
            [
                'label' => 'Imagen',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
                'value' => function($model) {
                    $url = yii\helpers\Url::to(['/galeria/update-galerias', 'tipo' => $model->galeria->tipo_galeria, 'tela_id' => $model->galeria->tela_id]);
                    if ($model->galeria->tipo_galeria == common\models\Galeria::MODEL0) {
//                    $url = yii\helpers\Url::to(['/galeria/ver-disenios', 'tela_id' => $model->galeria->tela_id,'GalleryImageSearch[name]'=>$model->galeria->color->name]);
                        $url = yii\helpers\Url::to(['/galeria/ver-disenios', 'tela_id' => $model->galeria->tela_id, 'GalleryImageSearch[name]' => $model->galeria->color->name ?? '']);
                    }
                    $img = Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                    $link = "<a data-pjax=0 target='_blank' href=$url  >$img</a>";
//                    return Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                    return $link;
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
            [
                'attribute' => 'estado',
                'format' => 'raw',
                'value' => function($model, $index) {
                    $label = "Normal";
                    $style = "default";
                    if ($model->estado == 1) {
                        $label = "Visible";
                        $style = "primary";
                    }
                    return Html::a($label, null, ["data-pjax" => 0, "data-id-dis" => $index, 'class' => "estado btn btn-$style"]);

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



</div>

