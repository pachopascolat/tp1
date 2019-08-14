<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EstampadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modelos de Diseños');

//$tela = $searchModel->galeria->tela;
$nombre_tela = $tela->nombre_tela;

//$categoria_padre = $tela->categoria->categoria_padre;

$menus = [null, "Hogar", "Moda"];

//$this->params['breadcrumbs'][] = [
//    'label' => Yii::t('app', $menus[$categoria_padre]),
//    'url' => ['/categoria/index', 'categoria_padre' => $categoria_padre]
//];
//$this->params['breadcrumbs'][] = [
//    'label' => Yii::t('app', $tela->categoria->nombre_categoria),
//    'url' => ['/tela/index-por-categoria', 'categoria_id' => $tela->categoria_id]
//];
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
//            'id',
//            'galeria.tela_id',
            [
                'attribute' => 'codigo_tela',
                'value' => 'galeria.tela.codigo_tela'
            ],
            [
                'attribute' => 'nombre_tela',
                'value' => 'galeria.tela.nombre_tela'
            ],
//            'galeria.tela.codigo_tela',
//            [
//                'label' => 'nombreTela',
//                'value' => function($model) {
//                    return $model->getNombreTela();
//                }
//            ],
//            'ownerId',
//            [
//                'attribute'=>'ownerId',
//                'label'=>'Id Disenio',
//            ],
//            [
//                'label'=>'Nombre Tela',
//                'attribute'=>'nombreTela',
////                'value'=>function($model,$index){
////                    return $model->getTela()->nombre_tela;
////                }
//            ],
            'name',
            'description',
            [
                'label' => 'Imagen',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
                'value' => function($model) {
                    $url = yii\helpers\Url::to(['/galeria/update-galerias', 'tipo' => $model->galeria->tipo_galeria, 'tela_id' => $model->galeria->tela_id]);
                    $img = Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                    $link = "<a data-pjax=0 target='_blank' href=$url  >$img</a>";
//                    return Html::img($model->getUrl('preview'), ['class' => 'img-thumbnail']);
                    return $link;
                }
            ],
//            [
//                'label' => 'foto',
//                'format' => 'raw',
//                'value' => function($model) {
//                    $src = $model->getUrl('preview');
//                    return Html::img($src, ['width' => '50px']);
//                }
//            ],
//            'name',
//            [
//                'attribute' => 'name',
//                'label' => 'codigo',
//            ],
            [
                'label' => 'cant. Modelos',
                'width' => '10%',
                'value' => function($model) {
                    $galeria = common\models\Galeria::findOne(['color_id' => $model->id]);
                    $cant = 0;
                    if ($galeria) {
                        $images = $galeria->getBehavior('galleryBehavior')->getImages();
                        $cant = count($images);
                    }
//                    $modelo = \common\models\Modelo::findOne(['disenio_id' => $model->id]);
//                    if ($modelo != null) {
//                        $cant += count($modelo->getBehavior('galleryBehavior')->getImages());
//                    }
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
                    $modelo = common\models\Galeria::findOne(['color_id' => $model->id]);
                    if ($modelo == null) {
                        $modelo = new \common\models\Galeria(['color_id' => $model->id,'tela_id'=>$model->galeria->tela_id]);
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
