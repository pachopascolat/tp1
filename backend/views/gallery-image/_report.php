<?php
\backend\assets\AppAsset::register($this);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>




<div class="container-fluid">
    <table>
        <?php
        $filas = array_chunk($data, 5);
        foreach ($filas as $fila):
            ?>
            <tr>
                <?php foreach ($fila as $estampado) : ?>
                    <td align="center">
                        <label style="width: 100px;" class="pdf-img-container">
                            <img style="width: 100px" src="<?= $estampado->getUrl('preview') ?>" class="">

                            <span style="width: 100px; text-align: center"><?= $estampado->id ?></span>

                        </label>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>


    </table>
    <!--</div>-->
</div>