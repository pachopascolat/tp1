<?php
/* @var common\models\Vidriera $vidriera */
//$columnas = 5;

$columnaIregular = $columnas - 2;

$items = $dataProvider->getModels();



$itemsRegular = array_slice($items, (($columnaIregular * 2) + 1));

//$columnas = 7;
//$filaRestoItems = \common\models\Utiles::armarGridRegular($restoItems, $columnas); 
?>
<div class="dos-filas-principal ">
    <div class="container">
        <?php echo $this->render('_fila_no_regular', ['items' => $items, 'columnas' => $columnaIregular]); ?>

        <?php echo $this->render('_fila_regular', ['items' => $itemsRegular, 'columnas' => $columnas]); ?>
        <div class="row">
            <div class="col">
                <?php
                echo yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->getPagination(),
                ]);
                ?>
            </div>
        </div>
    </div>
</div>