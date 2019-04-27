<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$menus = [null, "Hogar", "Moda"];

$this->title = Yii::t('app', "Categorias de $menus[$categoria_padre]");
$this->params['breadcrumbs'][] = $menus[$categoria_padre];
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nueva Categoria'), ['create', 'categoria_padre' => $searchModel->categoria_padre], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => '',
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    $searchModel = new common\models\TelaSearch(['categoria_id' => $model->id_categoria]);
                    $dataProvider = $searchModel->search(null);
                    return Yii::$app->controller->renderPartial('/tela/gridview', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'categoria_padre' => $model->categoria_padre]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true
            ],
//            'id_categoria',
            'nombre_categoria',
            'descripción:ntext',
            'orden_categoria',            
            [
                'label' => 'Ver Telas',
                'format'=>'raw',
                'value' => function($model){
                    $cant = 0;
                    $cant += count($model->telas);
                    return Html::a(
                            "($cant) Telas",['/tela/index-por-categoria','categoria_id'=>$model->id_categoria],['class'=>'btn btn-info']);
                }
            ],
//            [
//                'label' => 'Accion',
//                'format'=>'raw',
//                'value' => function($model){
//                    return Html::a('Editar',['update','id'=>$model->id_categoria],['class'=>'btn btn-warning'])." ".Html::a('Borrar',['delete','id'=>$model->id_categoria],['data-method'=>'POST','class'=>'btn btn-danger']);
//                }
//            ],
            
            
//            'categoria_padre',
//            'orden_categoria',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
