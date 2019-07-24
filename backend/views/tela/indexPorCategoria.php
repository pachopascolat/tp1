<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TelaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$menus = [null, "Hogar", "Moda"];

$this->title = Yii::t('app', "Telas de {$searchModel->categoria->nombre_categoria}");
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $menus[$categoria_padre]),
    'url' => ['/categoria/index', 'categoria_padre' => $categoria_padre]
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $searchModel->categoria->nombre_categoria),
    'url' => ['/tela/index-por-categoria', 'categoria_id' => $searchModel->categoria_id]
];
$this->params['breadcrumbs'][] = 'Telas';
?>
<div class="tela-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

<!--    <p>
    <?= Html::a(Yii::t('app', 'Create Tela'), ['create', 'categoria_padre' => $categoria_padre], ['class' => 'btn btn-success']) ?>
    </p>-->
    <!--Pjax::begin();-->
    <?= Html::a(Yii::t('app', 'Nueva Tela'), ['create', 'categoria_padre' => $categoria_padre, 'categoria_id' => $searchModel->categoria_id], ['class' => 'btn btn-success']) ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
//        'id_tela',
            'codigo_tela',
            'nombre_tela',
//            'descripcion_tela',
            'orden_tela',
//            [
//                'label' => 'Categoria',
//                'attribute' => 'categoria.nombre_categoria',
//            ],
//        'path_foto_tela',
//        'orden_tela',
//        'categoria_id',
            //'largo',
            //'ancho',
//            [
//                'label'=>'Grupos Viejo',
//                'format'=>'raw',
//                'value' => function ($model, $key, $index, $column) {
//                    return Html::a('Grupos Viejo', ['/grupo/ver-grupos','tela_id'=>$model->id_tela,'categoria_padre'=>$model->categoria->categoria_padre], ['class'=>'btn btn-default']);
//                }
//            ],
            [
                'label' => 'Diseños',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("({$model->getCantidadDisenios()}) Diseños", ['/galeria/update-galerias','tipo'=> common\models\Galeria::DISENIO, 'tela_id' => $model->id_tela, 'categoria_padre' => $model->categoria->categoria_padre], ['class' => 'btn btn-default']);
                }
            ],
            [
                'label' => 'Modelos',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("({$model->getCantidadModelos()}) Modelos", ['/galeria/ver-disenios', 'tela_id' => $model->id_tela], ['class' => 'btn btn-default']);
                }
            ],
            [
                'label' => 'Lisos',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("({$model->getCantidadLisos()}) Lisos", ['/galeria/ver-lisos', 'tela_id' => $model->id_tela], ['class' => 'btn btn-default']);
                }
            ],
            [
                'label' => 'Discontinuos',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a("({$model->getCantidadDiscontinuos()}) Discontinuo", ['/galeria/ver-discontinuo', 'tela_id' => $model->id_tela], ['class' => 'btn btn-default']);
                }
            ],
            [
                'label' => 'Stock',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('Stock', ['/gallery-image/ver-stock', 'tela_id' => $model->id_tela], ['class' => 'btn btn-default']);
                }
            ],
            [
                'label' => 'Exportar',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('Exportar', ['/gallery-image/exportar', 'tela_id' => $model->id_tela], ['class' => 'btn btn-default']);
                }
            ],
//            [
////                'label' => 'Diseños',
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '50px',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
////                    $searchModel = new common\models\TelaSearch(['categoria_id' => $model->id_categoria]);
////                    $dataProvider = $searchModel->search(null);
//
//                    return Yii::$app->controller->renderPartial('_disenios', ['model' => $model, 'categoria_padre' => $model->categoria->categoria_padre]);
//                },
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//                'expandOneOnly' => true,
//                'expandIcon'=> "Diseños ".GridView::ICON_EXPAND,   
//            ],
//            [
////                'label' => 'Diseños',
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '50px',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
//
//                    if ($model->discontinuos == null) {
//                        $discontinuoModel = new \common\models\Discontinuos(['tela_id' => $model->id_tela]);
//                        $discontinuoModel->save();
//                    } else {
//                        $discontinuoModel = $model->discontinuos;
//                    }
//                    return Yii::$app->controller->renderPartial('/discontinuos/_disenios', ['model' => $discontinuoModel, 'categoria_padre' => $model->categoria->categoria_padre]);
//                },
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//                'expandOneOnly' => true,
//                'expandTitle' => 'discontinuos',
//                'expandIcon' => "Discontinuos " . GridView::ICON_EXPAND,
//            ],
//            [
////                'label' => 'Diseños',
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '50px',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
////                    $searchModel = new common\models\TelaSearch(['categoria_id' => $model->id_categoria]);
////                    $dataProvider = $searchModel->search(null);
//                    if ($model->lisos == null) {
//                        $lisoModel = new common\models\Lisos(['tela_id' => $model->id_tela]);
//                        $lisoModel->save();
//                    } else {
//                        $lisoModel = $model->lisos;
//                    }
//
//                    return Yii::$app->controller->renderPartial('/lisos/_disenios', ['model' => $lisoModel, 'categoria_padre' => $model->categoria->categoria_padre]);
//                },
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//                'expandOneOnly' => true,
//                'expandIcon' => "Lisos " . GridView::ICON_EXPAND,
//            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php // Pjax::end(); ?>
</div>
