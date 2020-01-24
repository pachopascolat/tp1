<?php
$iconosMovil = common\models\Vidriera::find()->where(['categoria_id' => common\models\Categoria::ICONOSMOVIL])->limit(5)->all();
?>
<div class="movil-iconos d-md-none pt-3" >
    <div class="container">
        <div class="row">
            <?php foreach ($iconosMovil as $vidriera): ?>
                <div class="col">
                    <div>
                        <a href="<?= \yii\helpers\Url::to(['/sitio/por-vidriera', 'id' => $vidriera->id_vidriera]) ?>">
                            <img alt="icono" class="w-100" src="<?= \Yii::$app->imagemanager->getImagePath($vidriera->imagen_id) ?>" alt="<?= $vidriera->nombre ?>">
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
            <!--            <div class="col">
                            <div>
                                <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                                    <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-blanco-01.svg" alt="ketten">
                                </a>
                            </div>
            
                        </div>
                        <div class="col">
                            <div>
                                <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>">
                                    <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-infantil.png" alt="ketten">
                                </a>
                            </div>
            
                        </div>
                        <div class="col">
                            <div>
                                <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                                    <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-feria-01.svg" alt="ketten">
            
                                </a>
                            </div>
            
                        </div>
                        <div class="col">
                            <div>
                                <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 1]) ?>">
                                    <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-cortinas.png" alt="ketten">
            
                                </a>
                            </div>
            
                        </div>-->
            <div class="col">
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => 2]) ?>">
                        <img alt="icono" class="w-100" src="<?= yii\helpers\Url::base(true) ?>/img2020/categorias-movil-vermas-01.svg" alt="ketten">

                    </a>
                </div>

            </div>
        </div>
        <div class="row ">
            <?php foreach ($iconosMovil as $vidriera): ?>
                <div class="col text-center text-nowrap">
                    <span ><?= $vidriera->nombre ?></span>
                </div>
            <?php endforeach; ?>
<!--            <div class="col text-center text-nowrap">
                <span >Sabaneria</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Infantil</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Moda</span>
            </div>
            <div class="col text-center text-nowrap">
                <span >Cortinas</span>
            </div>-->
            <div class="col text-center text-nowrap">
                <span >Ver mas</span>
            </div>
        </div>
    </div>
</div>