

<!-- Hero Section-->
<section class="hero">
    <div class="container">
         <!--Breadcrumbs--> 
        <ol class="breadcrumb justify-content-left pl-0">
            <li class="breadcrumb-item">
                <a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Lista de consultas        </li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Consulta</h1>
<!--            <div class="row">   
              <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
            </div>-->
        </div>
    </div>
</section>
<!-- Shopping Cart Section-->


<?php
if ($_SESSION['carrito'] != ''):
    $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
    if ($carrito->itemCarritos != null):
        ?>
        <section>
            <div class="container"> 

                <?php
                \yii\widgets\Pjax::begin(['id' => 'cart-pjax']);
                ?>
                <table class="cart table table-striped">
                    <thead class="cart-header text-center btn-title  btn-dark">
                        <tr>
                            <th class="d-none d-md-table-cell">Tela</th>
                            <th class="d-none d-md-table-cell">Color</th>
                            <th>Diseño</th>
                            <th class="d-none d-sm-table-cell ">Item</th>
                            <!--<th class="d-none d-md-table-cell ">Tipo Tela</th>-->
                            <th>Cantidad</th>
                            <?= Yii::$app->user->isGuest ? '' : '<th>Precio</th>' ?>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="cart-body">
                        <?php
                        foreach ($carrito->itemCarritos as $key => $item):
                            
                            ?>

<!--                            <tr class="d-sm-none">
                                <td colspan="5">
                                    <div class="cart-title text-left">
                                        <a  class="text-uppercase text-dark">
                                            <strong> <?= $item->articulo->articulo->tela->nombre_tela ?></strong>
                                        </a>
                                    </div>
                                </td>
                            </tr>-->
                        <tr id="<?=$item->id_item_carrito?>" class="cart-item text-center">
                                <td class="align-middle d-none d-md-table-cell">
                                    <strong> <?= $item->articulo->articulo->tela->codigo_tela  ?></strong>
                                </td>
                                <td class="align-middle d-none d-md-table-cell">
                                    <strong> <?= $item->articulo->articulo->codigo_color  ?></strong>
                                </td>
                                <td class="align-middle">
                                    <div class="imagen-carrito">
                                        <div class="codigo-centrado d-md-none">
                                            <strong > <?= $item->articulo->articulo->codigo_color ?></strong>
                                        </div>
                                        <img src="<?=Yii::$app->imagemanager->getImagePath($item->articulo->imagen_id, 120, 120); ?>" alt="..." class="cart-item-img lazy">
                                    </div>
                                </td>
                                <td class="align-middle d-none d-sm-table-cell ">
                                    <div class="cart-title text-left">
                                        <a  class="text-uppercase text-dark">
                                            <strong> <?= $item->articulo->articulo->tela->nombre_tela ?></strong>
                                            <strong> <?= $item->articulo->articulo->nombre_color ?></strong>
                                        </a>
                                    </div>
                                </td>
                                
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div data-id="<?= $item->id_item_carrito ?>" class="btn btn-items btn-items-decrease cambiar-cantidad">-</div>
                                        <input type="text" value="<?= $item->cantidad ?>" class="form-control text-center input-items input-cant">
                                        <div  data-id="<?= $item->id_item_carrito ?>" class="btn btn-items btn-items-increase cambiar-cantidad">+</div>
                                    </div>
                                </td>
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <td class="align-middle">
                                        <input data-id="<?= $item->id_item_carrito ?>" type="text" value="<?= $item->precio ?>" class="form-control text-center cambiar-precio">
                                    </td>
                                <?php endif; ?>
                                <td class="align-middle">
                                    <div>
                                        <a href="#" data-item-id="<?= $item->id_item_carrito ?>"  class="cart-remove">
                                            <i class="text-dark far fa-window-close"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>


                    </tbody>
                </table>
                <?php
                \yii\widgets\Pjax::end();
                ?>



                <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                    <a href="<?= \yii\helpers\Url::to(['hogar']) ?>" class="btn btn-link text-muted">
                        <i class="fa fa-chevron-left">            
                        </i> Continuar agregando
                    </a>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#pedido-facturacion">
                            Pedido Facturación
                        </button>
                    <?php else: ?>
                        <a class="btn btn-dark"  data-toggle="modal" href="#pedido-simple" role="button" aria-expanded="false" aria-controls="collapseContacto">

                            Realizar Consultar 
                            <i class="fa fa-chevron-right">
                            </i>                           
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    <?php else : ?>
        <div class="text-center">
            <a href="<?= \yii\helpers\Url::to(['hogar']) ?>" class="btn btn-link text-muted">
                <i class="fa fa-chevron-left">            
                </i> Continuar agregando
            </a>
        </div>
    <?php endif; ?>

<?php endif; ?>




