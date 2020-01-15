
<?php
if(isset($filas)){
    $items = array_slice($items,0, ($columnas*$filas));
}
$items = \common\models\Utiles::armarGridRegular($items, $columnas); 

?>
<div class="fila-regular">
    <?php foreach ($items as $fila): ?>
        <div class="row">
            <?php foreach ($fila as $item): ?>
                <div class="col">        
                    <?php if ($item) : ?>
                        <?php $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null, 200, 200) ?>
                        <?php // $url2 = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null) ?>
                        <?php // $this->render('_modalItem', ['item' => $item, 'url' => $url2]) ?>
                        <div class="hover-div">
                            <a data-toggle="modal" data-target="#item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $item->id_item_vidriera ?>">
                                <img src="<?= yii\helpers\Url::base(true) . "/img2020/loading.png" ?>" alt="item tela" class="w-100 lazy" data-src="<?= $url ?>">
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