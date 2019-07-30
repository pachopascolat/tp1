<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategoriaTelaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categoria Telas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-tela-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categoria Tela', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_categoria_tela',
            'tela_id',
            'categoria_id',
            'orden',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
