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

foreach ($telas as $vidriera){
    $items[] = common\models\ItemVidirera::find()->where(['vidriera_id'=>$vidriera->id_vidriera])->limit(18)->all();
}
//array_multisort(array_map('count', $items), SORT_DESC, $items);

foreach ($items as $key => $vidriera) {
    if (true) {
        echo $this->render('dosFilasRegular', ['vidriera' => $vidriera]);
    }
}
?>
