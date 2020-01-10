<?php

use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Vidrieras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vidriera->nombre, 'url' => ['ordenar-vidriera', 'id' => $vidriera->id_vidriera]];
?>
<div class="items-vidrieras-div ordenar-vidriera">
    <div class="" style="display: flex; justify-content: space-between; align-items: center">

        <h1 style="margin: 0"><?= $vidriera->nombre ?></h1>

        <div class="">
            <!--<p class="">-->
            <a class="btn btn-info <?= ($vidriera->categoria == common\models\Categoria::findOne(['nombre_categoria' => 'PDF'])) ? '' : 'd-none' ?>" href="<?= \yii\helpers\Url::to(['/pdf-report/create-pdf', 'vidriera_id' => $vidriera->id_vidriera]) ?>">
                Hacer PDF
            </a>
            <a class="btn btn-success" target="_blank" href="<?= Yii::$app->urlManagerFrontEnd->createUrl(['/sitio/por-vidriera', 'id' => $vidriera->id_vidriera]) ?? '' ?>">
                Ver en Front
            </a>
            <!--</p>-->
        </div>
    </div>
    <hr>
    <p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nuevo-item">
            Agregar Item
        </button>
        <button data-confirm="Esta seguro que desea borrar todos los items?"  type="button" class="btn btn-danger items-borrar-todo">
            Borrar Todo
        </button>

    </p>
    
    <?php
//    yii\widgets\Pjax::begin(['id' => 'item-vidriera-pjax']);
    echo
    $this->render('_items_vidriera', [
        'vidriera' => $vidriera,
//        'articuloSearch' => $articuloSearch,
//        'dataProvider' => $dataProvider
    ]);
//    yii\widgets\Pjax::end();
    ?>
    <?php
//yii\widgets\Pjax::begin(['id' => 'item-vidriera-pjax']);

    echo
    $this->render('_modal_nuevo_item', [
        'vidriera' => $vidriera,
        'articuloSearch' => $articuloSearch,
        'dataProvider' => $dataProvider
    ]);
//yii\widgets\Pjax::end()
    ?>
    <?php
    echo
    $this->render('_modal_imagenes_galeria', [
//    'vidriera' => $vidriera,
//    'dataProvider' => $dataprovider,
        'dataProvider2' => $dataProvider2,
        'articuloSearch' => $articuloSearch,
        'imagenSearch' => $imagenSearch
    ])
    ?>
</div>