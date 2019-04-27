<?php

use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\Html;

//Pjax::begin();
?>
<?= Html::a(Yii::t('app', 'Nueva Tela'), ['/tela/create', 'categoria_padre' => $categoria_padre], ['class' => 'btn btn-success']) ?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
//        'id_tela',
        'codigo_tela',
        'nombre_tela',
        'descripcion_tela',
//        'path_foto_tela',
//        'orden_tela',
//        'categoria_id',
        //'largo',
        //'ancho',
        [
            'label' => 'Accion',
            'format' => 'raw',
            'value' => function($model) {
                return Html::a('Editar', ['/tela/update', 'id' => $model->id_tela], ['class' => 'btn btn-warning']) . " " . Html::a('Borrar', ['/tela/delete', 'id' => $model->id_tela], ['data-method' => 'POST', 'class' => 'btn btn-danger']);
            }
        ],
//        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>
<?php // Pjax::end(); ?>
