
<style>
    .help-block{
        color: red;
    }
</style>



<?php
//echo $this->render('nav3_sin');


echo $this->render('cart', ['id_carrito' => $carrito->id_carrito]);
echo $this->render('lector_codigo');
?>





<?php if(Yii::$app->user->isGuest):?>

<?php echo $this->render('_consulta_normal', ['model' => $model, 'carrito' => $carrito]);?>

<?php else:?>

<?php
yii\bootstrap4\Modal::begin([
    'options' => [
        'id' => 'pedido-facturacion',
        'tabindex' => false, // important for Select2 to work properly
    ],
    'headerOptions' => [
        'class' => 'd-none',
    ],
//    'title' => "<h6 class='btn-title  btn-dark w-100' >Tus Datos</h6>"
]);

echo $this->render('_clientePedido', ['model' => $model, 'carrito' => $carrito]);

yii\bootstrap4\Modal::end();
?>
<?php endif; ?>
<!--<div id="pedido-facturacion" class="modal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
<?php // echo $this->render('_clientePedido', ['model' => $model, 'carrito' => $carrito]);  ?>
            </div>
        </div>
    </div>
</div>-->




