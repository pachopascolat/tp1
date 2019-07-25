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



<div class="">
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
//    Pjax::begin(['id' => 'pjax-disenios']);

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
//            count($sinCargar) > 0 ? Html::button('Sin Cargar', ['class' => 'btn btn-default', 'data-toggle' => "modal", 'data-target' => "#sin-cargar"]) : '',
            $import,
            '{export}', '{toggleData}'
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "Diseños Sin Cargar",
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//             [
//        'class' => '\kartik\grid\CheckboxColumn'
//    ],
//            'id',
//            'galeria.tipo_galeria',
//            [
//                'attribute'=>'tipo_galeria',
//                'value'=>function($model){
//                    if($model->galeria->tipo_galeria ==1){
//                        return "Diseño";
//                    }else{
//                        return "Modelo";
//                    }
//                }
//            ],
            'codigo_tela',
            
            'nombre_tela',
          
            'name',
            'description',
//          
        ],
    ]);
    ?>

    <?php // Pjax::end();
    ?>

</div>
