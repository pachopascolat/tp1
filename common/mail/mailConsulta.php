
<h3>Se ha realizado la consulta nro <?= $carrito->id_carrito ?></h3>
<p>EL cliente <?= $carrito->cliente->nombre_cliente ?></p>
<p>Telefono: <?= $carrito->cliente->telefono ?></p>
<p>email: <?= $carrito->cliente->mail_cliente ?></p>

<table width="80%" border="1" bordercolor="#0000FF" cellpadding="10">
    <thead>
        <tr>
            <th>codigo disenio</th>
            <th>imagen</th>
            <th>codigo tela</th>
            <th>tela</th>
            <th>Tipo</th>
            <th>cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($carrito->itemCarritos as $item):
            ?>
        <tr>
            <td><?=$item->disenio->name?></td>
            <td><?php
               $web = yii\helpers\Url::base('https');
                    $url = $item->getUrl('preview');
                    $path = $url;
                    $parts = explode('/', $path);
                    $parts = array_slice($parts, 3);
//                    $newpath = implode('/', $parts);
//                    $urlok = $web ."/". $newpath;
//                    echo yii\helpers\Html::img($web.$url, ['class' => 'img-thumbnail']);
                    ?>
                    <a href="<?php echo $url ?>"><img width="80px" src="<?= $url ?>"> </a> 
                </td>
                
               
            <td><?=$item->getCodigoTela()?></td>
            <td><?=$item->getNombreTela()?></td>
            <td>
                <?=$item->getTipoTela();?>
            </td>
            <td><?=$item->cantidad?></td>
            
        </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>



