
<?php

use \Milon\Barcode\DNS2D;
use barcode\barcode\BarcodeGeneratorAssets;

//BarcodeGeneratorAssets::register($this);

//$d = new DNS2D();
//$d->setStorPath(Yii::getAlias('@web') . "/cache/");
?>

<h3>Se ha realizado la consulta nro <?= $carrito->id_carrito ?></h3>
<p>EL cliente <?= $carrito->cliente->nombre_cliente ?></p>
<p>Telefono: <?= $carrito->cliente->telefono ?></p>
<p>email: <?= $carrito->cliente->mail_cliente ?></p>
<p>cuit: <?= $carrito->cliente->cuit ?></p>
<p>nro cliente: <?= $carrito->cliente->nro_cliente ?></p>
<p>direccion de envio: <?= $carrito->direccion_envio?></p>
<p>presupuesto: <?= $carrito->getPresupuesto()?></p>
<p>Observaciones: <?= $carrito->observaciones ?></p>

<table width="80%" border="1" bordercolor="#0000FF" cellpadding="10">
    <thead>
        <tr>
            <th>Codigo Tela</th>
            <th>Codigo Color</th>
            <th>Imagen</th>
            <th>Tela</th>
            <th>Color</th>
            <th>Piezas</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Precio</th>
            <th>Codigo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($carrito->itemCarritos as $item):
            ?>
            <tr>
                <td><?= $item->articulo->tela->codigo_tela ?? 'vacio' ?></td>
                <td><?= $item->articulo->codigo_color ?? 'vacio' ?></td>
                <td><?php
                    $web = yii\helpers\Url::base('https');
                    $url = \yii\helpers\Url::base(true) . Yii::$app->imagemanager->getImagePath($item->imagen_id, 80, 80);
                    ?>
                    <a href="<?php echo $url ?>"><img width="80px" src="<?= $url ?>"> </a>
                </td>



                <td><?= $item->articulo->tela->nombre_tela?? 'vacio' ?></td>
                <td>
                   <?= $item->articulo->nombre_color??'vacio'; ?>
                </td>
                <td><?= $item->piezas ?></td>
                <td><?= $item->cantidad ?></td>
                <td><?= $item->unidad ?></td>
                <td><?= $item->precio ?></td>
                <td>
                    <div>
                        <?php
//                        if ($item->serie) {
//                            echo $d->getBarcodeHTML($item->serie, "DATAMATRIX", 5, 5);
//                        }
                        ?>
                    </div>
                </td>

            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>



