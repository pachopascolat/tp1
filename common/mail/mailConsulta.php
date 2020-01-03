
<h3>Se ha realizado la consulta nro <?= $carrito->id_carrito ?></h3>
<p>EL cliente <?= $carrito->cliente->nombre_cliente ?></p>
<p>Telefono: <?= $carrito->cliente->telefono ?></p>
<p>email: <?= $carrito->cliente->mail_cliente ?></p>

<table width="80%" border="1" bordercolor="#0000FF" cellpadding="10">
    <thead>
        <tr>
            <th>Codigo Tela</th>
            <th>Codigo Color</th>
            <th>Imagen</th>
            <th>Tela</th>
            <th>Color</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($carrito->itemCarritos as $item):
            ?>
            <tr>
                <td><?= $item->articulo->tela->codigo_tela ?></td>
                <td><?= $item->articulo->codigo_color ?></td>
                <td><?php
                    $web = yii\helpers\Url::base('https');
                    $url = $item->getUrl('preview');
                    $path = $url;
                    $parts = explode('/', $path);
                    $parts = array_slice($parts, 3);
                    $newpath = implode('/', $parts);
                    $urlok = $web . "/" . $newpath;
//                    echo yii\helpers\Html::img($web.$url, ['class' => 'img-thumbnail']);
                    ?>
                    <a href="<?php echo $urlok ?>"><img width="80px" src="<?= $urlok ?>"> </a> 
                </td>


                
                <td><?= $item->articulo->tela->nombre_tela ?></td>
                <td>
                    <?= $item->articulo->nombre_color; ?>
                </td>
                <td><?= $item->cantidad ?></td>

            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>



