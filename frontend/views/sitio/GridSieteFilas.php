<?php
/* @var common\models\Vidriera $vidriera */
$items = $vidriera->itemVidireras;
$primerasFilas = array_slice($items, 1, 10);
if (count($primerasFilas) < 10) {
    $resto = 10 - count($primerasFilas);
    for ($i = 0; $i < $resto; $i++) {
        $primerasFilas[] = null;
    }
}
$filasPrimera = array_chunk($primerasFilas, 5);
$restoItems = array_slice($items, 11);

if (count($restoItems) % 7 != 0) {
    $resto = 7 - count($restoItems) % 7;
    for ($i = 0; $i < $resto; $i++) {
        $restoItems[] = null;
    }
}
$filaRestoItems = array_chunk($restoItems, 7);
?>
<div class="dos-filas-principal ">
    <div class="container">

        <div class="row">
            <div class="flex-2">  
                <?php $item = $items[0] ?? null; ?>
                <div class="col">
                    <?php if ($item) : ?>
                        <?php $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ??null,100,100) ?>
                        <?php $url2 = Yii::$app->imagemanager->getImagePath($item->imagen_id ??null) ?>
                        <?php // $url = yii\helpers\Url::base(true)."/backend/uploads/{$item->imagen->id}_{$item->imagen->fileHash}.jpg" ?>
                        <?= $this->render('_modalItem', ['item' => $item, 'url' => $url2]) ?>
                        <div class="hover-div">

                            <a data-toggle="modal" data-target="#item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $item->id_item_vidriera ?>">
                                <img class="w-100 lazy" data-src="<?= $url ?>">
                                <div class="item-vidriera d-flex align-items-center justify-content-center">
                                    <img data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lazy lupa-item align-self-center">
                                    <span class="text-light w-100 text-center"><?= $item->articulo->nombre_color ?? '' ?></span>
                                </div>
                            </a>       
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex-5">
                <?php foreach ($filasPrimera as $fila): ?>
                    <div class="d-flex">
                        <?php foreach ($fila as $item): ?>
                            <div class="col">
                                <?php if ($item) : ?>
                                    <?php $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null, 100, 100) ?>
                                    <?php $url2 = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null) ?>
                                    <?= $this->render('_modalItem', ['item' => $item, 'url' => $url2]) ?>
                                    <div class="hover-div">

                                        <a data-toggle="modal" data-target="#item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $item->id_item_vidriera ?>">
                                            <img class="w-100 lazy" data-src="<?= $url2 ?? '' ?>">
                                            <div class="item-vidriera d-flex align-items-center justify-content-center">
                                                <img data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lazy lupa-item align-self-center">
                                                <span class="text-light w-100 text-center"><?= $item->articulo->nombre_color ?? '' ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php foreach ($filaRestoItems as $fila): ?>
            <div class="row">
                <?php foreach ($fila as $item): ?>
                    <div class="col">        
                        <?php if ($item) : ?>
                            <?php $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null, 100, 100) ?>
                            <?php $url2 = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null) ?>
                            <?= $this->render('_modalItem', ['item' => $item, 'url' => $url2]) ?>
                            <div class="hover-div">
                                <a data-toggle="modal" data-target="#item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $item->id_item_vidriera ?>">
                                    <img class="w-100 lazy" data-src="<?= Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null) ?? '' ?>">
                                    <div class="item-vidriera d-flex align-items-center justify-content-center">
                                        <img data-src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lazy lupa-item align-self-center">
                                        <span class="text-light w-100 text-center"><?= $item->articulo->nombre_color ?? '' ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>                        
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>