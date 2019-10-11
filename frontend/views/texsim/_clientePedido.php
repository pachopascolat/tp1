
<?php // echo $this->render('/layouts/menu', ['categoria_padre' => $categoria_padre]);          ?>
<?php // echo $this->render('cart', ['categoria_padre' => $categoria_padre, 'id_carrito' => $carrito->id_carrito]);         ?>

<section>
    <div class="p-4">
        <div class="">

            <div class="">
                <div class="block">

                    <h6 class="btn-title  btn-dark " >Tus Datos</h6>

                    <div class="block-body"> 
                      <!--<p class="lead">¿Aún no es nuestro cliente registrado?</p>
                      <p class="text-muted">Con el registro con nuestro portal, podrá realizar sus pedidos mas rápido. ¡Todo el proceso no llevará más de unos minutos!</p>
                      <p class="text-muted">Si tiene alguna pregunta, no dude en <a href="#">contactarnos</a>, nuestro centro de servicio al cliente se comunicará a la brevedad.</p>
                      <hr>-->
                        <!--<form action="customer-orders.html" method="get">-->
                        <?php
                        $form = \yii\widgets\ActiveForm::begin([
                                    'enableAjaxValidation' => true,
//                                    'action' => ['pedido-facturacion', 'categoria_padre' => $categoria_padre]
                        ]);
                        ?>
                        <!--                            <div class="form-group">
                                                        <label for="name" class="form-label">Nro Cliente</label>
                                                        <input id="name" type="text" class="form-control">
                        <?= $form->field($model, 'nro_cliente')->textInput(['class' => 'form-control','id'=>'nro-cliente-input'])->label(false) ?>
                                                    </div>-->

                        <div class="form-group">
                            <label for="name" class="form-label">Cuit</label>
                            <!--<input id="name" type="text" class="form-control">-->
                            <?= $form->field($model, 'cuit')->textInput(['class' => 'form-control'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre o Razón Social</label>
                            <!--<input id="name" type="text" class="form-control">-->
                            <?= $form->field($model, 'nombre_cliente')->textInput(['class' => 'form-control','id'=>'nombre-cliente-input'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <!--<input id="email" type="text" class="form-control">-->
                            <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control','id'=>'telefono-cliente-input'])->label(false) ?>

                        </div>
                        <div class="form-group">
                            <label for="mail_cliente" class="form-label">Mail</label>
                            <!--<input id="Usuario" type="Usuario" class="form-control">-->
                            <?= $form->field($model, 'mail_cliente')->textInput(['type' => 'email', 'class' => 'form-control','id'=>'email-cliente-input'])->label(false) ?>

                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Direccion Envio</label>
                            <!--<input id="name" type="text" class="form-control">-->
                            <?= $form->field($model, 'direccion_envio')->textInput(['class' => 'form-control'])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Observaciones</label>
                            <!--<input id="name" type="text" class="form-control">-->
                            <?= $form->field($carrito, 'observaciones')->textarea(['class' => 'form-control'])->label(false) ?>
                        </div>
                        <!--                            <div class="form-group">
                                                        <label for="password" class="form-label">Contraseña</label>
                                                        <input id="Contraseña" type="Contraseña" class="form-control">
                                                    </div>-->
                        <hr>

                        <div class="loading-div d-flex justify-content-center flex-column flex-lg-row">
                            <!--                            <div class="form-group text-center">
                                                            <button type="submit" class="btn btn-outline-secondary"><svg class="svg-icon"><use xlink:href="#envelope-1"> </use></svg><p>ENVIAR POR MAIL</p> </button>
                                                        </div>-->
                            <div class="form-group text-center">
                                <button type="submit" formaction="<?= \yii\helpers\Url::to(['pedido-facturacion', 'categoria_padre' => $categoria_padre]) ?>" id="" type="" class="btn btn-outline-secondary">
                                    <svg class="svg-icon">
                                    <use xlink:href="#envelope-1"> 
                                    </use>
                                    </svg>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span class="sr-only">Loading...</span>
                                    <p>ENVIAR POR MAIL</p> 

                                </button>
                            </div>
                        </div>

                    </div>
                    <!--                            </form>-->
                    <?php \yii\widgets\ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
