<?php
$iconos = common\models\Vidriera::find()->where(['categoria_id' => common\models\Categoria::ICONOS])->limit(16)->orderBy('orden_vidriera')->all();
$iconosFilas = array_chunk($iconos, 8);
?>

<div class="dosFilasIconos mt-5">
    <div class="container">
        <h3>Mas telas..</h3>
        <!-- row 1 -->
        <?php foreach ($iconosFilas as $fila) : ?>
            <div class="row">
                <?php foreach ($fila as $vidriera) : ?>
                    <div class="col ">                                
                        <a href="<?= \yii\helpers\Url::to(['/sitio/por-vidriera', 'id' => $vidriera->id_vidriera]) ?>">
                            <div class="icono-div">
                                <img alt="icono" class="lazy w-100" data-src="<?= \Yii::$app->imagemanager->getImagePath($vidriera->imagen_id) ?>" alt="<?=$vidriera->nombre?>">
                                <span class="w-100 icono-nombre text-center"><?= $vidriera->nombre ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>
</div> <!-- container end -->
</div>
