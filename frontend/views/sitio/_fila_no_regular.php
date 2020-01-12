<?php
$portada = $items[0]??null;
$items = array_slice($items, 1, ($columnas*2));
//$itemsResto = \common\models\Utiles::armarGridRegular($items, $columnas);
?>
<div class="row">
    <div class="flex-2">  
        <div class="col">
            <?php if ($portada) : ?>
                <?php $url = Yii::$app->imagemanager->getImagePath($portada->imagen_id ?? null, 200, 200) ?>
                <?php $url2 = Yii::$app->imagemanager->getImagePath($portada->imagen_id ?? null) ?>
                <?php // $url = yii\helpers\Url::base(true)."/backend/uploads/{$item->imagen->id}_{$item->imagen->fileHash}.jpg" ?>
                <?php // $this->render('_modalItem', ['item' => $portada, 'url' => $url2]) ?>
                <div class="hover-div">

                    <a data-toggle="modal" data-target="#item-modal-<?= $portada->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $portada->id_item_vidriera ?>">
                        <img src="<?= yii\helpers\Url::base(true) . "/img2020/loading.png" ?>" alt="item tela" class="w-100 lazy" data-src="<?= $url2 ?>">
                        <div class="item-vidriera d-flex align-items-center justify-content-center">
                            <img data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lazy lupa-item align-self-center">
                            <span class="text-light w-100 text-center"><?= $portada->articulo->nombre_color ?? '' ?></span>
                        </div>
                    </a>       
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="" style="flex: <?= $columnas?>">
        <?php echo $this->render('_fila_regular', ['items' => $items,'columnas'=>$columnas,'filas'=> 2]); ?>

    </div>
</div>