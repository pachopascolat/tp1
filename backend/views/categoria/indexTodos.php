<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$menus = [null, "Hogar", "Moda"];
//
//$this->title = Yii::t('app', "Categorias de $menus[$categoria_padre]");
//$this->params['breadcrumbs'][] = $menus[$categoria_padre];
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nueva Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'categoriaPadre.nombre_categoria',
            'nombre_categoria',
            [
                'attribute'=>'moda',
                'value' => function($model){
                    return $model->moda?"Moda":"";
                }
                ],
            [
                'attribute'=>'hogar',
                'value' => function($model){
                    return $model->hogar?"Hogar":"";
                }
                ],
//            'hogar',
            'orden_hogar',
//            'moda',
            'orden_moda',
//            'descripción:ntext',
//            'orden_categoria',            
            [
                'label' => 'Ver Telas',
                'format'=>'raw',
                'value' => function($model){
                    $cant = 0;
                    $cant += count($model->telas);
                    return Html::a(
                            "($cant) Telas",['/categoria-tela/index-por-categoria','categoria_id'=>$model->id_categoria],['class'=>'btn btn-info']);
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
