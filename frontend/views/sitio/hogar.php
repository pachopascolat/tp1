<?php

/* @var $this yii\web\View */

echo $this->render('nav3');

$categoria_padre = $_SESSION['categoria_padre']??1;
//$categoria_padre = 1;

$telas = \common\models\base\Vidriera::find()->joinWith(['categoria'])->where(['hogar' => $categoria_padre])
        ->orderBy([new \yii\db\Expression('orden_vidriera IS NULL, orden_vidriera ASC')])
//        ->limit(3)
        ->all();

foreach ($telas as $vidriera){
    $items[] = $vidriera->itemVidireras;
}
array_multisort(array_map('count', $items), SORT_DESC, $items);

foreach ($items as $key => $vidriera) {
    if ($key < 4) {
        echo $this->render('dosFilasRegular', ['vidriera' => $vidriera]);
    }
}

echo $this->render('dosFilasIconos');
echo $this->render('filaImagenesRedes');

?>
<br>