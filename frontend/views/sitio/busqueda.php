
<?php
/* @var $this yii\web\View */

echo $this->render('nav3');
?>
<div class="container">
    <h3>Resultados para: <?= $busqueda ?></h3>
</div>
<?php
$items = [];
?>
<div class="dos-filas-regular mt- mb-2">
    <div class="container">

        <?php
        foreach ($vidrieras as $vidriera):
            if ($vidriera->itemsStock):
                ?>
                <a href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera->id_vidriera]) ?>"><h3><?= $vidriera->nombre ?? '' ?></h3> </a>
                <div class="d-sx-block d-md-none">
                    <?php echo $this->render('_fila_no_regular', ['items' => $vidriera->itemsStock, 'columnas' => 2, 'filas' => 3]); ?>
                </div>
                <div class="d-none d-md-block d-lg-none">
                    <?php echo $this->render('_fila_regular', ['items' => $vidriera->itemsStock, 'columnas' => 7, 'filas' => 2]); ?>
                </div>
                <div class="d-none d-lg-block">
                    <?php echo $this->render('_fila_regular', ['items' => $vidriera->itemsStock, 'columnas' => 9, 'filas' => 2]); ?>
                </div>
                <?php echo $this->render('_modalItem', ['items' => $vidriera->itemsStock]) ?>
                <div class="d-flex justify-content-end">
                    <a class="text-dark" href="<?= yii\helpers\Url::to(['por-vidriera', 'id' => $vidriera->id_vidriera]) ?>">
                        <h5 >ver mas</h5>
                    </a>
                </div>
                <?php
            endif;
        endforeach;
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