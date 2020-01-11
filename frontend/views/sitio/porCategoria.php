<?php
/* @var $this yii\web\View */

echo $this->render('nav3');

//$categoria_padre = $_SESSION['categoria_padre']??1;
//$categoria_padre = 1;
//$telas = \common\models\base\Vidriera::find()->joinWith(['categoria'])->where(['hogar' => $categoria_padre])
//        ->orderBy([new \yii\db\Expression('orden_vidriera IS NULL, orden_vidriera ASC')])
////        ->limit(3)
//        ->all();
$items = [];
$vidrieras = $telas;

//foreach ($telas as $vidriera) {
//    $items[] = common\models\ItemVidirera::find()->where(['vidriera_id' => $vidriera->id_vidriera])->limit(18)->all();
//}
//$items = \common\models\Utiles::normalizarGrid($telas,18);
//array_multisort(array_map('count', $items), SORT_DESC, $items);
?>
<div class="dos-filas-regular mt- mb-2">
    <div class="container">

        <?php
        foreach ($vidrieras as $vidriera):
            ?>
            <a href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera->id_vidriera]) ?>"><h3><?= $vidriera->nombre ?? '' ?></h3> </a>
            <div class="d-sx-block d-md-none">
                <?php echo $this->render('_fila_no_regular', ['items' => $vidriera->itemVidireras, 'columnas' => 2, 'filas' => 3]); ?>
            </div>
            <div class="d-none d-md-block d-lg-none">
                <?php echo $this->render('_fila_regular', ['items' => $vidriera->itemVidireras, 'columnas' => 7, 'filas' => 2]); ?>
            </div>
            <div class="d-none d-lg-block">
                <?php echo $this->render('_fila_regular', ['items' => $vidriera->itemVidireras, 'columnas' => 9, 'filas' => 2]); ?>
            </div>
            <?php echo $this->render('_modalItem', ['items' => $vidriera->itemVidireras]) ?>
                <div class="d-flex justify-content-end">
                    <a class="text-dark" href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera->id_vidriera]) ?>">
                        <h5 >ver mas</h5>
                    </a>
                </div>
        <?php endforeach;
        ?>
    </div>
</div>


<div class="d-sx-block d-md-none">
    <?= $this->render('_iconos_sx') ?>
</div>
<div class="d-none d-md-block d-lg-none">
    <?= $this->render('_iconos_md') ?>
</div>
<div class="d-none d-lg-block">
    <?= $this->render('_iconos_lg') ?>
</div>


<div class="d-none d-md-block">
    <?= $this->render('filaImagenRedesDos') ?>
</div>