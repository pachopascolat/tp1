<nav class="" id="sidebar">
    <ul class="list-unstyled components">
        <li class="pb-2">
            <a class="sb-titulo " href="#">Ordenar publicacion</a>
            <ul class="list-unstyled pt-1">
                <li>
                    <a class="sb-opciones" href="#">Mas visitadas</a>
                </li>
                <li>
                    <a class="sb-opciones" href="#">Novedades</a>
                </li>
            </ul>
        </li>
        <li class="pb-2">
            <a class="sb-titulo" href="#">Sucursales</a>
            <ul class="list-unstyled pt-1">
<!--                <li><span class="sb-opciones">Lavalle 2571 / 2120 0550</span> </li>
                <li><span class="sb-opciones">Azcuenaga 580 / 2120 0580</span></li>
                <li><span class="sb-opciones">Olavarria 2348 / 6072 6831</span></li>
                <li><span class="sb-opciones">Villa Celina</span></li>-->
                <li>
                    <a  class="sb-opciones" href="#sucLavalle" data-toggle="collapse" aria-expanded="false">Lavalle</a>
                    <div id="sucLavalle" class="collapse">
                        <span  class="sb-opciones">Lavalle 2571 / 2120 0550</span>
                    </div>
                </li>
                <li>
                    <a class="sb-opciones" href="#sucCelina" data-toggle="collapse" aria-expanded="false">Celina</a>
                    <div id="sucCelina" class="collapse">
                        <span  class="sb-opciones">Olavarria 2348 / 6072 6831 </span>
                    </div>
                </li>
                <li>
                    <a class="sb-opciones" href="#sucAzcuenaga" data-toggle="collapse" aria-expanded="false">Azcuenaga</a>
                    <div id="sucAzcuenaga" class="collapse">
                        <span  class="sb-opciones">Azcuenaga 580 / 2120 0580 </span>
                    </div>
                </li>
            </ul>
        </li>
        <li class="pb-2">
            <a class="sb-titulo" href="#">Moda</a>
            <ul class="list-unstyled pt-1">
                <?php
                $moda = common\models\Categoria::findOne(['nombre_categoria' => 'Moda']);
                foreach ($moda->categorias as $cat):
                    ?>
                    <li>
                        <a class="sb-opciones" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => $cat->id_categoria]) ?>"><?= $cat->nombre_categoria ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="pb-2">
            <a class="sb-titulo" href="#">Hogar</a>
            <ul class="list-unstyled pt-1">
                <?php
                $hogar = common\models\Categoria::findOne(['nombre_categoria' => 'Hogar']);
                foreach ($hogar->categorias as $cat):
                    ?>
                    <li>
                        <a class="sb-opciones" href="<?= \yii\helpers\Url::to(['/sitio/por-categoria', 'id_categoria' => $cat->id_categoria]) ?>"><?= $cat->nombre_categoria ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="sb-titulo dropdown-toggle">Telas</a>
            <ul class="collapse list-unstyled pt-1 overflow-auto" id="homeSubmenu">
                <?php
                $vidrieras = \common\models\Vidriera::find()->joinWith('categoria')
                        ->where(['categoria_padre' => [1, 2]])
                        ->orderBy('nombre')
//                        ->orderBy('catego ria_padre, orden_vidriera')
                        ->all();
                foreach ($vidrieras as $cat):
                    ?>
                    <li>
                        <a class="sb-opciones" href="<?= \yii\helpers\Url::to(['/sitio/por-vidriera', 'id' => $cat->id_vidriera]) ?>"><?= $cat->nombre ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </li>
    </ul>
</nav> 
<div class="pr-4">
    <div class="mb-3">
        <div class="">
            <a href="#" >
                <img class="img-fluid w-100"  src="<?= yii\helpers\Url::base(true) ?>/img2020/youtube.jpg" alt="">
            </a>
        </div>
    </div>
    <div class="">
        <div class="">
            <?php
//            $url = '';
//            $tela = $vidriera->itemVidireras[0]->articulo->tela ?? null;
//            if ($tela) {
//                $pdf = common\models\PdfReport::findOne(['tela_id' => $tela->id_tela ?? null]);
//                $url = yii\helpers\Url::to(['sitio/descargar-pdf', 'id' => $pdf->id_pdf_report ?? null, 'vidriera_id' => $vidriera->id_vidriera]);
//            }
            ?>
            <a href="<?php // echo $url       ?>" data-toggle="modal" data-target="#pdf-report-modal" >
                <img class="img-fluid w-100"  src="<?= yii\helpers\Url::base(true) ?>/img2020/banner-texsim-lateral-pdf.jpg" alt="">
            </a>
        </div>
    </div>
</div>

