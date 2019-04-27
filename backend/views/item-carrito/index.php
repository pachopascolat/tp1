<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ItemCarritoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Items Consulta');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-carrito-index">



    <?=
    GridView::widget([
        'exportConfig' => [
            GridView::CSV => ['label' => 'Export as CSV', 'filename' => 'File_Name-' . date('d-M-Y')],
            GridView::HTML => ['label' => 'Export as HTML', 'filename' => 'File_Name -' . date('d-M-Y')],
//            GridView::PDF => ['label' => 'Export as PDF', 'filename' => 'File_Name -' . date('d-M-Y')],
            GridView::EXCEL => [
                'label' => 'Export as EXCEL', 
                'filename' => 'File_Name -' . date('d-M-Y')],
            
            GridView::TEXT => ['label' => 'Export as TEXT', 'filename' => 'File_Name -' . date('d-M-Y')],
        ],
        'export' => [
            'fontAwesome' => true
        ],
//        'exportConfig' => [
//            GridView::EXCEL => [
//                'label' => ( 'Exportar en Excel'),
//                'iconOptions' => ['class' => 'text-success'],
//                'showHeader' => true,
//                'showPageSummary' => true,
//                'showFooter' => true,
//                'showCaption' => true,
////                'filename' => ("Pedido de {$searchModel2->carrito->cliente->nombre_cliente}_".date('d_m_Y', strtotime($searchModel2->carrito->timestamp)).""),
//                'alertMsg' => ( 'El archivo de exportación EXCEL se generará para descargar.'),
//                'options' => ['title' => ( 'Microsoft Excel 95+')],
//                'mime' => 'application/vnd.ms-excel',
//                'config' => [
//                    'worksheet' => ( 'ExportWorksheet'),
//                    'cssFile' => '',
//                    'methods' => [
//                        'SetHeader' => ['Your Title Here'],
//                    ],
//                ]
//            ],
//        ],
        'id' => 'item-carrito-grid-' . $key,
        'toolbar' => [
            Html::a(Yii::t('app', 'Editar Carrito'), Yii::$app->urlManagerFrontEnd->baseUrl . "/texsim/update-consulta?categoria_padre=1&id_carrito=$searchModel2->carrito_id", ['class' => 'btn btn-warning', 'target' => '_blank']),
            '{export}', '{toggleData}'
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "Pedido de {$searchModel2->carrito->cliente->nombre_cliente} , tel: {$searchModel2->carrito->cliente->telefono}, mail: {$searchModel2->carrito->cliente->mail_cliente}",
        ],
        'dataProvider' => $dataProvider2,
        'filterModel' => $searchModel2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'carrito.cliente.nombre_cliente',
                'hidden' => true,
            ],
            [
                'attribute' => 'carrito.cliente.telefono',
                'hidden' => true,
            ],
            [
                'attribute' => 'carrito.cliente.mail_cliente',
                'hidden' => true,
            ],
//            'id_item_carrito',
            [
                'label' => 'Imagen',
                'format' => 'html',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
                'value' => function($model) {
                    $web = Url::base('http');
                    $url = $model->getUrl('preview');
                    return Html::img($web . $url, ['style'=>'width:100px','width'=>'20px']);
//                    return "<img width='50px' src=".$web.$url.">";
                }
            ],
            [
                'attribute' => 'disenio.name',
                'label' => 'Codigo',
            ],
//            'disenio.name',
//            'carrito_id',
//            'cantidad',
            [
                'attribute' => 'cantidad',
                'contentOptions' => ['style' => 'width:50px; white-space: normal;'],
            ],
            [
                'label' => 'Código Tela',
                'value' => function($model) {
                    return $model->getCodigoTela();
                }
            ],
            [
                'label' => 'Tela',
                'value' => function($model) {
                    return $model->getNombreTela();
                }
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
