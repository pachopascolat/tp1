<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$menus = [null, "Hogar", "Moda"];
//$this->title = Yii::t('app', "Categorias de $categoria_padre");
//$this->params['breadcrumbs'][] = $categoria_padre;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nueva Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php if ($searchModel->categoria_padre != -1): ?>
            <?= Html::a(Yii::t('app', 'Ordenar'), ['ordenar-categorias-padre', 'id' => $searchModel->categoria_padre], ['class' => 'btn btn-info']) ?>
        <?php endif; ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'label' => '',
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '50px',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detail' => function ($model, $key, $index, $column) {
//                    $searchModel = new common\models\TelaSearch(['categoria_id' => $model->id_categoria]);
//                    $dataProvider = $searchModel->search(null);
//                    return Yii::$app->controller->renderPartial('/tela/gridview', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'categoria_padre' => $model->categoria_padre]);
//                },
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//                'expandOneOnly' => true
//            ],
//            'id_categoria',
            'nombre_categoria',
//            'descripción:ntext',
//            'orden_categoria',            
//            [
//                'attribute' => 'orden_hogar',
//                'visible' => $categoria_padre == "Hogar"
//            ],
//            [
//                'attribute' => 'orden_moda',
//                'visible' => $categoria_padre == "Moda"
//            ],
//            [
//                'label' => 'Ver Telas',
//                'format' => 'raw',
//                'value' => function($model) {
//                    $cant = 0;
//                    $cant += count($model->telas);
//                    return Html::a(
//                                    "($cant) Telas", ['/tela/index-por-categoria', 'categoria_id' => $model->id_categoria], ['class' => 'btn btn-info']);
//                }
//            ],
//            [
//                'label' => 'Accion',
//                'format'=>'raw',
//                'value' => function($model){
//                    return Html::a('Editar',['update','id'=>$model->id_categoria],['class'=>'btn btn-warning'])." ".Html::a('Borrar',['delete','id'=>$model->id_categoria],['data-method'=>'POST','class'=>'btn btn-danger']);
//                }
//            ],
//            'categoria_padre',
//            'orden_categoria',
            [
//                'label' => 'Diseños',
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
//                'detail' => function ($model, $key, $index, $column) {
//                    $searchModel = new common\models\ArticuloSearch(['tela_id'=>$model->id_tela]);
//                    $dataProvider = $searchModel->search(null);
//                    return Yii::$app->controller->renderPartial('/articulo/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
//                },
                'detailUrl' => yii\helpers\Url::to(['/vidriera/index-por-categoria  ']),
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true,
                'expandTitle' => 'Vidrieras',
                'expandIcon' => "Vidrieras " . GridView::ICON_EXPAND,
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
