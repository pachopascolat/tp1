<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Vidriera */

$this->title = $model->id_vidriera;
$this->params['breadcrumbs'][] = ['label' => 'Vidriera', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vidriera-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Vidriera'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id_vidriera], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_vidriera], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_vidriera',
        'nombre',
        'estado',
        [
            'attribute' => 'categoria.id_categoria',
            'label' => 'Categoria',
        ],
        'orden_vidriera',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerItemVidirera->totalCount){
    $gridColumnItemVidirera = [
        ['class' => 'yii\grid\SerialColumn'],
            'id_item_vidriera',
            [
                'attribute' => 'articulo.id_articulo',
                'label' => 'Articulo'
            ],
            [
                'attribute' => 'imagen.id',
                'label' => 'Imagen'
            ],
                        'orden_item_vidriera',
            'ranking',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerItemVidirera,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-item-vidirera']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Item Vidirera'),
        ],
        'export' => false,
        'columns' => $gridColumnItemVidirera
    ]);
}
?>

    </div>
    <div class="row">
        <h4>Categoria<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCategoria = [
        'id_categoria',
        'nombre_categoria',
        'descripción',
        'categoria_padre',
        'orden_categoria',
        'hogar',
        'moda',
        'orden_hogar',
        'orden_moda',
    ];
    echo DetailView::widget([
        'model' => $model->categoria,
        'attributes' => $gridColumnCategoria    ]);
    ?>
</div>
