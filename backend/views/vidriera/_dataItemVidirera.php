<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->itemVidireras,
        'key' => 'id_item_vidriera'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'id_item_vidriera',
        [
                'attribute' => 'articulo.id_articulo',
                'label' => 'Articulo'
            ],
        [
                'attribute' => 'imagen.id',
                'label' => 'Imagen'
            ],
        'orden_item_vidriera',
        'ranking',
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'item-vidirera'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
