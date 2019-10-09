
<style>
    .help-block{
        color: red;
    }
</style>

<?= $this->render('/layouts/menu', ['categoria_padre' => $categoria_padre]); ?>

<!--        <section class="hero">
    <div class="container">
         Breadcrumbs 
        <ol class="breadcrumb justify-content-left">
            <li class="breadcrumb-item"><a href="<?= \yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Tus Datos</li>
        </ol>
         Hero Content
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Tus Datos</h1>
            <div class="row">   
              <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
            </div>
        </div>   
    </div>
</section>-->
<?php
echo $this->render('cart', ['categoria_padre' => $categoria_padre, 'id_carrito' => $carrito->id_carrito]);
?>

<div id="collapseContacto" class="collapse">
    <!-- customer login-->
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6">
                    <div class="block">

                        <h6 class="btn-title  btn-dark " >Tus Datos</h6>

                        <div class="block-body"> 
                          <!--<p class="lead">¿Aún no es nuestro cliente registrado?</p>
                          <p class="text-muted">Con el registro con nuestro portal, podrá realizar sus pedidos mas rápido. ¡Todo el proceso no llevará más de unos minutos!</p>
                          <p class="text-muted">Si tiene alguna pregunta, no dude en <a href="#">contactarnos</a>, nuestro centro de servicio al cliente se comunicará a la brevedad.</p>
                          <hr>-->
                            <!--<form action="customer-orders.html" method="get">-->
                            <?php $form = \yii\widgets\ActiveForm::begin([
                                'enableAjaxValidation'=>true,
                            ]); ?>
                            <div class="form-group">
                                <label for="name" class="form-label">Nombre o Razón Social</label>
                                <!--<input id="name" type="text" class="form-control">-->
                                <?= $form->field($model, 'nombre_cliente')->textInput(['class' => 'form-control'])->label(false) ?>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <!--<input id="email" type="text" class="form-control">-->
                                <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control'])->label(false) ?>

                            </div>
                            <div class="form-group">
                                <label for="mail_cliente" class="form-label">Mail</label>
                                <!--<input id="Usuario" type="Usuario" class="form-control">-->
                                <?= $form->field($model, 'mail_cliente')->textInput(['class' => 'form-control'])->label(false) ?>

                            </div>
                            <!--                            <div class="form-group">
                                                            <label for="password" class="form-label">Contraseña</label>
                                                            <input id="Contraseña" type="Contraseña" class="form-control">
                                                        </div>-->
                            <hr>
                            <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                                
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-outline-secondary"><svg class="svg-icon"><use xlink:href="#envelope-1"> </use></svg><p>ENVIAR POR MAIL</p> </button>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" formaction="<?= \yii\helpers\Url::to(['crear-consulta-whats-app', 'categoria_padre' => $categoria_padre]) ?>" id="consulta-whatsapp" type="" class="btn btn-outline-secondary"><svg class="svg-icon"><use xlink:href="#envelope-1"> </use></svg><p>ENVIAR POR WHATSAPP</p> </div>
                            </div>
                        </div>
                        <!--                            </form>-->
                        <?php \yii\widgets\ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div id="pedido-facturacion" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<!--      <div class="modal-header">
        <h5 class="modal-title">Pedido Facturación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>-->
      <div class="modal-body">
        <?php echo $this->render('_clientePedido',['categoria_padre' => $categoria_padre, 'model' => $model, 'carrito' => $carrito]); ?>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>-->
    </div>
  </div>
</div>


<?= $this->render('/layouts/footer'); ?>
<script>
    
</script>

