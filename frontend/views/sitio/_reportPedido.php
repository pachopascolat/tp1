<?php
\backend\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html>
    <body>
        <style>
            table {
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
            }

            th,td {
                text-align: center;
                vertical-align: central;

            }
            label{
                font-weight: bold;
            }
            .pagina-pdf{
                padding: 2em;
            }
            .img-titulo-pdf{
                margin-bottom: -6px;
            }
        </style>
        <div class="pagina-pdf">


            <div  class="centrar">


                <div>
                    <h1><img class="img-titulo-pdf" src="<?= yii\helpers\Url::base(true) . "/img/favicon-32x32.png" ?>"><span>   Texsim Pedido nro: <?= $carrito->id_carrito ?></span></h1>
                </div>
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
                    <span><?= $carrito->mail_cliente ?? '' ?></span>
                </div>
                <div class="">

                    <label>Total Presupuesto: </label>

                    <span>$<?= $carrito->getPresupuesto() ?? '' ?></span>

                </div>

                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tela</th>
                            <th>Color</th>
                            <th>Diseño</th>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Codigo</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        foreach ($carrito->itemCarritos as $item):
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
                                        <strong> <?= $item->cantidad ?? '' ?></strong>
                                    </div>
                                </td>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <td class="align-middle">
                                        <strong>$ <?= $item->precio ?? '' ?></strong>
                                    </td>
                                <?php endif; ?>
                                <td></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>