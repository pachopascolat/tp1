
<style>
    .help-block{
        color: red;
    }
</style>



<?php
//echo $this->render('nav3_sin');


echo $this->render('cart', ['id_carrito' => $carrito->id_carrito]);
if (!Yii::$app->user->isGuest) {
    echo $this->render('lector_codigo');
}
?>





<?php if (Yii::$app->user->isGuest): ?>

    <?php
    echo $this->render('_consulta_normal', ['model' => $model, 'carrito' => $carrito]);
    ?>

<?php else: ?>

    <?php
    echo $this->render('_clientePedido', ['model' => $model, 'carrito' => $carrito]);
    ?>
    <!--<div id="pedido-facturacion" class="modal"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
    <?php // echo $this->render('_clientePedido', ['model' => $model, 'carrito' => $carrito]);   ?>
                </div>
            </div>
        </div>
    </div>-->
<?php endif; ?>




