<?php

use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Vidrieras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $vidriera->nombre, 'url' => ['ordenar-vidriera', 'id' => $vidriera->id_vidriera]];
?>
<div class="items-vidrieras-div ordenar-vidriera">
    <h1><?= $vidriera->nombre ?></h1>
    <p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nuevo-item">
            Agregar Item
        </button>
        <a class="btn btn-success" target="_blank" href="<?= Yii::$app->urlManagerFrontEnd->createUrl(['/sitio/por-vidriera', 'id' => $vidriera->id_vidriera])??'' ?>">
            Ver en Front
        </a>
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