<?php
\backend\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
    <body>
        <div class="pagina-pdf">
            <?php echo $this->render("_pdfHeader") ?>
            <div  class="centrar">
                <h1><?= $data[0]->getNombreTela() ?></h1>
                <table align="center">
                    <?php $filas = array_chunk($data, 5); ?>
                    <?php foreach ($filas as $fila): ?>
                        <tr>
                            <?php foreach ($fila as $estampado) : ?>
                                <td>
                                    <div>  
                                        <label style="text-align: center" class="pdf-img-container">
                                            <div>
                                                <span class="codigo-tela"><?= $estampado->getTela()->codigo_tela ?></span>
                                            </div>
                                            <img style="width: 90px" src="<?= $estampado->getUrl('preview') ?>" class="">
                                            <div>
                                                <span class="codigo-estampado"><?= $estampado->id ?></span>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <?php
                            endforeach;
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php echo $this->render("_pdfFooter", ['nro' => $nro]) ?>
        </div>
    </body>
</html>