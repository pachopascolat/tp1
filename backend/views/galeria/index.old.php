<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GaleriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galerias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Galeria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_galeria',
            'nombre_galeria',
            'columnas',
            'slides',
            'tela_id',
            'orden',
            'tipo_galeria',
            'color_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
