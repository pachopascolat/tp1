<?php

//use barcode\barcode\BarcodeGenerator;
use \Milon\Barcode\DNS2D;

$d = new DNS2D();
$d->setStorPath(__DIR__ . "/cache/");
?>
<!DOCTYPE html>
<html>
    <head>
        <!--<script type="text/javascript" src="js/bwip-js-min.js"></script>-->
    </head>
    <body>

        <div id="print-area">
            <div id="header">
                <div>
                    <h1><img class="img-titulo-pdf" src="<?= yii\helpers\Url::base(true) . "/img/favicon-32x32.png" ?>">   Texsim Pedido nro: <?= $carrito->id_carrito ?> <span class="hoja-pdf"><?= " HOJA: $nro_hoja" ?></span></h1>
                </div>

            </div>
            <div id="content">
                <hr>
                <div>
                    <label>Vendedor: </label><span><?= $carrito->vendedor->username ?? '' ?></span>
                </div>
                <div>
                    <label>Fecha:</label> <span><?= $carrito->timestamp ?></span>
                </div>
                <div>
                    <label>Dirección Envío: </label>
                    <span><?= $carrito->direccion_envio ?? '' ?></span>
                </div>
                <div>
                    <label>Observaciones:</label>
                    <p>
                        <?= $carrito->observaciones ?>
                    </p>
                </div>
                <hr>
                <div>
                    <label>Nro Cliente: </label>
                    <span><?= $carrito->cliente->nro_cliente ?? '' ?></span>
                </div>
                <div>
                    <label>Cliente: </label>
                    <span><?= $carrito->cliente->nombre_cliente ?? '' ?></span>
                </div>
                <div>
                    <label>CUIT: </label>
                    <span><?= $carrito->cliente->cuit ?? '' ?></span>
                </div>
                <div>
                    <label>Telefono: </label>
                    <span><?= $carrito->cliente->telefono ?? '' ?></span>
                </div>
                <div>
                    <label>Email: </label>
                    <span><?= $carrito->cliente->mail_cliente ?? '' ?></span>
                </div>
                <div class="">

                    <label>Total Presupuesto: </label>

                    <span><?= $carrito->getPresupuesto() ?? '' ?></span>

                </div>

                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tela</th>
                            <th>Color</th>
                            <th>Diseño</th>
                            <th>Item</th>
                            <th>Piezas</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Precio</th>
                            <th>Codigo</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        foreach ($items as $item):
                            ?>
                            <tr id="<?= $item->id_item_carrito ?>" class="cart-item text-center">
                                <td class="align-middle d-none d-md-table-cell">
                                    <strong> <?= $item->articulo->tela->codigo_tela ?? '' ?></strong>
                                </td>
                                <td class="align-middle d-none d-md-table-cell">
                                    <strong> <?= $item->articulo->codigo_color ?? '' ?></strong>
                                </td>
                                <td class="align-middle">
                                    <div class="imagen-carrito">

                                        <img style="" src="<?= $item->articulo->getFrontFullUrl(50, 50) ?>" class="">
                                    </div>
                                </td>
                                <td class="align-middle d-none d-sm-table-cell ">
                                    <div class="cart-title text-left">
                                        <a  class="text-uppercase text-dark">
                                            <strong> <?= $item->articulo->tela->nombre_tela ?? '' ?></strong>
                                            <strong> <?= $item->articulo->nombre_color ?? '' ?></strong>
                                        </a>
                                    </div>
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <strong> <?= $item->piezas ?? '' ?></strong>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <strong> <?= $item->cantidad ?? '' ?></strong>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <strong> <?= $item->unidad ?? '' ?></strong>
                                    </div>
                                </td>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <td class="align-middle">
                                        <strong> <?= $item->precio ?? '' ?></strong>
                                    </td>
                                    <td class="align-middle">
                                        <div style="padding: 10px">
                                        <!--<strong> <?php // echo $item->serie ?? ''         ?></strong>-->
                                        <!--<div id="serie-<?php // echo $item->id_item_carrito   ?>"></div>-->
                                            <?php
                                            echo $d->getBarcodeHTML($item->serie, "DATAMATRIX", 5, 5);
                                            ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!--            <div id="footer">
                            This is an example footer.
                        </div>-->
        </div>


    </body>
</html>


