


<?php

use kartik\select2\Select2;
?>

<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!--Breadcrumbs--> 
        <ol class="breadcrumb justify-content-left pl-0">
            <li class="breadcrumb-item">
                <a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Lista de consultas        </li>
        </ol>
        <div class="hero-content pb-3 text-center">
            <h1 class="hero-heading">
                Consulta<a class="text-dark show-lector" href="#" >
                    <i class="p-2 fal fa-camera-retro" ></i>
                </a>
            </h1>

            <div class="col-md-8 m-auto <?= Yii::$app->user->isGuest ? 'd-none' : '' ?>">

                <input type="text" class="code-lector-input w-100 form-control" placeholder="Escanear Codigo">
            </div>

            <div class="col-md-8 m-auto pt-2 buscar-por-tela-variante w-100 m-auto">
                <?php
                $data = [];
                $articulos = common\models\Articulo::find()->where(['existencia' => 1])->all();
                foreach ($articulos as $articulo) {
                    $data[$articulo->id_articulo] = "{$articulo->tela->codigo_tela} - {$articulo->codigo_color} - {$articulo->tela->nombre_tela} - {$articulo->nombre_color}";
                }
//                        echo '<label for="buscador-cliente" class="form-label">Buscar</label>';
                echo Select2::widget([
                    'name' => 'buscador-tela-variante',
                    'data' => $data,
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Buscar por Tela y variante',
//                                'multiple' => true
                    ],
                    'pluginEvents' => [
                        "select2:select" => "function(data) {
                                    var id = $(this).val();
                                     $.pjax.reload({
                                        push: false,
                                        replace: false,
                                        url: '/sitio/agregar-item-desde-buscador',
                                        type: 'POST',
                                        data: {id:id},
                                        container: '#cart-pjax',
                                        timeout: false,
//                                        async: false,
                                    })
                                  }",
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>


        </div>

    </div>

</section>
<!-- Shopping Cart Section-->

<script>
    let agregarDesdeCodigo = function (code) {
        $.ajax({
            url: '/sitio/datos-codigo',
            type: 'POST',
            data: {code: code},
            success: function (e) {
                console.log(e);
                $('.carrito-count-div').each(function () {
                    $(this).removeClass('d-none');
                });

                $('.carrito-count').each(function () {
                    $(this).text(e);
                });
//                                consultaguardada();
                $.pjax.reload('#cart-pjax');
            }
        });
    }
</script>
<?php
\yii\widgets\Pjax::begin(['id' => 'cart-pjax']);
?>




<?php
$js = " 
                    
                    $('.cambiar-precio').on('change',function () {
                        var id = $(this).data('id');
                        var precio = $(this).val();
                        var input = $(this);
                        $.post({
                            url: '/sitio/cambiar-precio',
                            data: {precio: precio,id:id},
                            success: function (e) {
                                input.val(e)
                            }
                        });
                    });

                    


                    
                    $('.code-lector-input').change(function(){
                        var code = $('.code-lector-input').val();
                        if (code != '') {
                            agregarDesdeCodigo(code);
                        }
                        $(this).val('');
                    });
                    
                    $('.close-lector').click(function(){
                        $('#lector-wrap').addClass('d-none')

                    });
                    $('.show-lector').click(function(){
                        $('#lector-wrap').removeClass('d-none');
                    });
                    $('.cart-remove').on('click', function (event) {
                        //event.preventDefault();
                        var cart = $('#cart-pjax');
                        var id = $(this).data('item-id');
                        $.ajax({
                            url: '/sitio/delete-item',
                            type: 'POST',
                            data: {id: id},
                            success: function (e) {
                                var count = $('#item-carrito-count');
                                var oldcant = count.text();
                                var newcant = parseInt(oldcant) - 1;
                                if (newcant == 0) {
                                    $('.carrito-count-div').remove();
                                } else {
                                    $('.carrito-count').each(function () {
                                        $(this).text(newcant);
                                    });
                                }
                                $('#' + e).remove();
                            }
                        });
                    });
   

                    $('.btn-items-decrease').click(function () {
                        var id = $(this).data('id');
                        var input = $(this).siblings('.input-items');
                        $.post({
                            url: '/sitio/disminuir-cantidad',
                            data: {id: id},
                            success: function (e) {
                                input.val(e)

                            }
                        });
                    });
                    $('.btn-items-increase').click(function () {
                        var id = $(this).data('id');
                        var input = $(this).siblings('.input-items');
                        $.post({
                            url: '/sitio/aumentar-cantidad',
                            data: {id: id},
                            success: function (e) {
                                input.val(e)

                            }
                        });
                    });
                    ";
$this->registerJs($js);
?>




<?php
if ($_SESSION['carrito'] != ''):
    $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
    if ($carrito->itemCarritos != null):
        ?>
        <section>
            <div class="container"> 

                <table class="cart table table-striped">
                    <thead class="cart-header text-center btn-title  btn-dark">
                        <tr>
                            <th class="d-none d-md-table-cell">Tela</th>
                            <th class="d-none d-md-table-cell">Color</th>
                            <th>Diseño</th>
                            <th class="d-none d-sm-table-cell ">Item</th>
                            <!--<th class="d-none d-md-table-cell ">Tipo Tela</th>-->
                            <th>Cantidad</th>
                            <?= Yii::$app->user->isGuest ? '' : '<th class="">Precio</th>' ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="cart-body">
                        <?php
                        foreach ($carrito->itemCarritos as $key => $item):
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
                                        <div class="codigo-centrado     d-md-none">
                                            <div><strong > <?= $item->articulo->tela->codigo_tela ?? '' ?></strong></div>
                                            <div><strong > <?= $item->articulo->codigo_color ?? '' ?></strong></div>
                                        </div>
                                        <img src="<?= Yii::$app->imagemanager->getImagePath($item->imagen_id, 120, 120) ?? ''; ?>" alt="..." class="cart-item-img w-100 lazy">
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
                                        <div href="#" data-item-id="<?= $item->id_item_carrito ?>"  class="cart-remove cursor-pointer">
                                            <i class="text-dark far fa-window-close"></i>
                                        </div>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>


                    </tbody>
                </table>




                <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                    <a href="<?= \yii\helpers\Url::to(['hogar']) ?>" class="btn btn-link text-muted">
                        <i class="fa fa-chevron-left">            
                        </i> Continuar agregando
                    </a>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#pedido-facturacion">
                            Pedido Facturación
                        </button>
                        <a href="<?= yii\helpers\Url::to(['terminar']) ?>" class="btn btn-link text-muted" >
                            Finalizar
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

<?php
\yii\widgets\Pjax::end();
?>


