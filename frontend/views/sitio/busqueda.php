
<?php

/* @var $this yii\web\View */

echo $this->render('nav3');

$items=[];

foreach ($vidrieras as $vidriera){
    $items[] = $vidriera->itemVidireras;
}
//array_multisort(array_map('count', $items), SORT_DESC, $items);

foreach ($items as $key => $vidriera) {
    if ($key < 4) {
        echo $this->render('dosFilasRegular', ['vidriera' => $vidriera]);
    }
}
?>
<div class="text-center">
    <h5 class="<?= count($vidrieras)>0?'d-none':''?>"> No se encontraron resultados </h5>
</div>
<?php
echo $this->render('dosFilasIconos');
echo $this->render('filaImagenesRedes');

?>
<br>