<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CarritoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Consultas');
$this->params['breadcrumbs'] = [];
?>
<div class="carrito-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
    <?= Html::a(Yii::t('app', 'Create Carrito'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?=
    GridView::widget([
        'export' => false,
        'id' => 'carrito-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id_carrito',
                'width' => '80px',
            ],
//            'id_carrito',
            [
                'label' => 'Fecha',
                'value' => function($model) {
                    $date = date('d-m-Y', strtotime($model->timestamp));
                    return $date;
                }
            ],
            [
                'label' => 'Hora',
                'value' => function($model) {
                    $time = date('H:i:s', strtotime($model->timestamp));
                    return $time;
                }
            ],
            'cliente.nombre_cliente',
            'cliente.telefono',
            'cliente.mail_cliente',
            [
                'label' => 'Cantidad Telas',
                'value' => function($model) {
                    return count($model->itemCarritos);
                }
            ],
            [
//                'label' => 'Diseños',
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new \common\models\ItemCarritoSearch(['carrito_id' => $model->id_carrito]);
                    $dataProvider = $searchModel->search(null);
                    if ($dataProvider->totalCount > 0) {
                        return Yii::$app->controller->renderPartial('/item-carrito/index', ['searchModel2' => $searchModel, 'dataProvider2' => $dataProvider,'key'=>$key]);
                    }else{
                        return;
                    }
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true,
                'hiddenFromExport' => false,
                'expandTitle' => 'Consulta',
                'expandIcon' => "Ver Consulta " . GridView::ICON_EXPAND,
            ],
//            'timestamp',
//            'confirmado',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
