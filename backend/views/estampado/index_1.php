<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EstampadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modelos de Diseños');

$tela = $searchModel;
$nombre_tela = $tela->nombre_tela;

$categoria_padre = $tela->categoria->categoria_padre;

$menus = [null, "Hogar", "Moda"];

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $menus[$categoria_padre]),
    'url' => ['/categoria/index', 'categoria_padre' => $categoria_padre]
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $tela->categoria->nombre_categoria),
    'url' => ['/tela/index-por-categoria', 'categoria_id' => $tela->categoria_id]
];
$this->params['breadcrumbs'][] = $tela->getNombreCompleto();
?>
<div class="estampado-index">

    <h1><?= Html::encode($tela->getNombreCompleto()) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'ver en Frontend'), Yii::$app->urlManagerFrontEnd->createUrl(['estampados', 'id' => $tela->id_tela]), ['class' => 'btn btn-primary', 'target' => '_blank', 'data-pjax' => 0]) ?>

    </p>

    <?=
    GridView::widget([
        'toolbar' => [
            '{export}', '{toggleData}'
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "Modelos",
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_estampado',
//            'nombre_estampado',
//            'columnas',
//            'slides',
//            'tela_id',
//            'id',
//            'ownerId',
//            'rank',
            [
                'label' => 'foto',
                'format' => 'raw',
                'value' => function($model) {
                    $src = $model->getUrl('preview');
                    return Html::img($src, ['width' => '50px']);
                }
            ],
//            'name',
            [
                'attribute' => 'name',
                'label' => 'codigo',
            ],
            [
                'label' => 'cant. Modelos',
                'width' => '10%',
                'value' => function($model) {
                    $cant = 0;
                    $modelo = \common\models\Modelo::findOne(['disenio_id' => $model->id]);
                    if ($modelo != null) {
                        $cant += count($modelo->getBehavior('galleryBehavior')->getImages());
                    }
                    return $cant;
                }
            ],
            [
//                'label' => 'Diseños',
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '30%',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {

//                    if ($model->discontinuos == null) {
//                        $discontinuoModel = new \common\models\Discontinuos(['tela_id' => $model->id_tela]);
//                        $discontinuoModel->save();
//                    } else {
//                        $discontinuoModel = $model->discontinuos;
//                    }
                    $modelo = \common\models\Modelo::findOne(['disenio_id' => $model->id]);
                    if ($modelo == null) {
                        $modelo = new \common\models\Modelo(['disenio_id' => $model->id]);
                        $modelo->save();
                    }
                    return Yii::$app->controller->renderPartial('/modelo/_form', ['model' => $modelo]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true,
                'expandTitle' => 'Modelos',
                'expandIcon' => "Modelos " . GridView::ICON_EXPAND,
            ],
//            'images.id',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
