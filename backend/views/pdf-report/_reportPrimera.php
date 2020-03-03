<?php
\backend\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html>

    <body>
        <div class="pagina-pdf">

            <style>
                .header1-pdf{
                    background-image: url('<?= Yii::getAlias('@backend/web/pdf/headers/' . $header) ?>');
                }
            </style>


            <div>
                <a href="<?= yii\helpers\Url::base(true) . "/../designs?id=" . $data[0]->vidriera_id ?>">
                    <span>
                        <img style="width: 100%" src="
                        <?= Yii::getAlias('@backend/web/pdf/headers/' . $header) ?>
                             ">
                    </span>
                </a>
            </div>

            <?php
//            echo $this->render("_pdfHeader") 
            ?>
            <div  class="centrar">

                <table align="center">
                    <tr>
                        <td colspan="3">
                            <h1 style="text-align: left;"><?= strtoupper($model->vidrieraPdf->nombre) ?></h1>
                        </td>
                        <td>
                            <h2 style="text-align: right;">
                                <a target="_blank" class="titulo-1" href="<?= yii\helpers\Url::base(true) . "/../sitio/por-vidriera?id=" . $model->vidriera_pdf ?>">
                                    VER EN LA WEB
                                </a>
                            </h2>
                        </td>
                    </tr>
                    <?php $filas = array_chunk($data, 4); ?>
                    <?php foreach ($filas as $fila): ?>
                        <tr>
                            <?php foreach ($fila as $estampado) : ?>
                                <td width="25%">
                                    <div class="disenio-pdf">  
                                        <label style="text-align: center" class="pdf-img-container">
                                            <img style="width: 100%" src="<?= $estampado->getFullUrl(300,300) ?>" class="">
                                            <div>
                                                <span class="codigo-estampado-pdf"><?= (intval($estampado->articulo->codigo_color)<150 || intval($estampado->articulo->codigo_color)==9999 )?$estampado->articulo->nombre_color:$estampado->articulo->codigo_color ?></span>
                                            </div>
                                        </label>
                                    </div>
                                </td>

                                <?php
                            endforeach;
                            ?>
                            <?php
                            $restan = 4 - count($fila);
                            if ($restan > 0) {
                                for ($i = 0; $i < $restan; $i++) {
                                    echo "<td width='25%'></td>";
                                }
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php // echo $this->render("_pdfFooter", ['nro' => $nro])  ?>
        </div>
    </body>
</html>