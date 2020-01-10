<?php
$total = count($vidriera);
if ($total < 18) {
    $resto = 18 - $total;
    for ($j = 0; $j < $resto; $j++) {
        $vidriera[] = null;
    }
}
?>

<div class="dos-filas-regular mt- mb-2">
    <div class="container">
        <h3><?= $vidriera[0]->vidriera->nombre ?? '' ?></h3>
        <div class="cuadricula-regular">
            <?php
//            $i = 0;
            for ($key = 0; $key < 18; $key++):
                $item = $vidriera[$key];
                ?>

                <?= $key == 0 || $key == 9 ? '<div class="row">' : ''; ?>
                <?php
                $imagen_id = $item->imagen_id ?? '';
                $url = Yii::$app->imagemanager->getImagePath($imagen_id, 120, 120);
                $url2 = Yii::$app->imagemanager->getImagePath($imagen_id, 500, 500);
                ?>
                <div class="col">
                    <?php if ($item) : ?>
                        <?= $this->render('_modalItem', ['item' => $item, 'url' => $url2]) ?>
                        <div class="hover-div">
                            <a data-toggle="modal" data-target="#item-modal-<?= $item->id_item_vidriera ?? '' ?>" class="" href="" data-id-item="<?= $item->id_item_vidriera ?>">
                                <img src="<?= yii\helpers\Url::base(true) . "/img2020/loading.png" ?>" alt="item tela" class="disenio-img img-fluid lazy" data-src="<?= $url ?>">
                                <div class="item-vidriera d-flex align-items-center justify-content-center">
                                    <img src="<?= \yii\helpers\Url::base(true) ?>/img2020/lupa-01.svg" class="lupa-item align-self-center">
                                    <span class="text-light w-100 text-center"><?= $item->articulo->nombre_color ?? '' ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>


                <?= $key == 8 || $key == 17 ? '</div>' : ''; ?>
            <?php endfor; ?>
        </div>
        <?php if($total>17): ?>
        <div class="d-flex justify-content-end">
            <a class="text-dark" href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera[0]->vidriera_id]) ?>">
                <h5 >ver mas</h5>
            </a>
        </div>
        <?php else:
            echo "<hr>";
        endif;
        
        ?>
                  
    </div>
</div>
