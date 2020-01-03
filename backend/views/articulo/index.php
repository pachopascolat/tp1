<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Articulo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_articulo',
            'nombre_color',
            'tela_id',
            'tela.codigo_tela',
            'tela.nombre_tela',
            'codigo_color',
            [
              'format'=>'raw',
                'value'=> function($model){
                    $src = \Yii::$app->imagemanager->getImagePath($model->imagen_id, 50, 50,'inset');
                    return Html::img($src);
                }
            ],
            
//            'imagen_id',
            //'existencia',
            //'estado',
            //'nombre_articulo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
