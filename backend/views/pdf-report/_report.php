<?php
\backend\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
    <body>
        <div class="pagina-pdf">
            <div>
                <a href="http://texsim.com.ar">
                    <img style="width: 100%" src="
                    <?= Yii::getAlias('@backend/web/pdf/headers/' . $header2) ?>
                         ">
                </a>
            </div>

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
                                                <span class="codigo-estampado-pdf"><?= intval($estampado->articulo->codigo_color)<150?$estampado->articulo->nombre_color:$estampado->articulo->codigo_color ?></span>
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
                                    echo "<td></td>";
                                }
                            }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php // echo $this->render("_pdfFooter", ['nro' => $nro]) ?>
        </div>
    </body>
</html>