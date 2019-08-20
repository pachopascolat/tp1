<?php
\backend\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
    <body>
        <div class="pagina-pdf">
            <!--            <div class="" style="
                             width:21cm;
                             height: 7cm; 
                             background-image: url('<?php // echo Yii::getAlias('@backend/web/img/header-pdf.jpg')     ?>');
                             background-repeat: no-repeat;
                             background-size: cover;
                             ">
            
                        </div>-->
            <div>
                <a href="http://texsim.com.ar" >
                   <img style="width: 100%" src="
                       <?php // echo $header ?>
                     ">
                </a>
            </div>
            <?php
//            echo $this->render("_pdfHeader") 
            ?>
            <div  class="centrar">
                <h1><?= $data[0]->getNombreTela() ?></h1>
                <table align="center">
                    <?php $filas = array_chunk($data, 4); ?>
                    <?php foreach ($filas as $fila): ?>
                        <tr>
                            <?php foreach ($fila as $estampado) : ?>
                                <td width="25%">
                                    <div class="disenio-pdf">  
                                        <label style="text-align: center" class="pdf-img-container">
                                            <!--                                            <div>
                                                                                            <span class="codigo-tela"><?= $estampado->getTela()->codigo_tela ?></span>
                                                                                        </div>-->
                                            <img style="width: 100%" src="<?= $estampado->getUrl('preview') ?>" class="">
                                            <div>
                                                <span class="codigo-estampado-pdf"><?= $estampado->name ?></span>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <?php
                                $restan = 4 - count($fila);
                                if ($restan > 0) {
                                    for ($i = 0; $i < $restan; $i++) {
                                        echo "<td width='25%'></td>";
                                    }
                                }
                                ?>
                                <?php
                            endforeach;
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php // echo $this->render("_pdfFooter", ['nro' => $nro])  ?>
        </div>
    </body>
</html>