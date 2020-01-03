<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Vidriera */

?>
<div class="vidriera-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id_vidriera) ?></h2>
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
</div>