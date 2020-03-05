


    <?php

    use kartik\select2\Select2;
    ?>

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
    ?>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <section>
        <div class="p-4">

            <div class="block">

                <h6 class="btn-title  btn-dark " >Tus Datos</h6>

                <?php
                $form = \yii\widgets\ActiveForm::begin([
                            'id' => 'cliente-pedido-form',
                            'action' => ['pedido-facturacion']
                ]);
                ?>

                <div class="block-body"> 
                  <!--<p class="lead">¿Aún no es nuestro cliente registrado?</p>
                  <p class="text-muted">Con el registro con nuestro portal, podrá realizar sus pedidos mas rápido. ¡Todo el proceso no llevará más de unos minutos!</p>
                  <p class="text-muted">Si tiene alguna pregunta, no dude en <a href="#">contactarnos</a>, nuestro centro de servicio al cliente se comunicará a la brevedad.</p>
                  <hr>-->
                    <!--<form action="customer-orders.html" method="get">-->



                    <?php
                    $data = [];
                    $clientes = $model->find()->where(['not', ['nro_cliente' => null]])->all();
                    foreach ($clientes as $cliente) {
                        $data[$cliente->id_cliente] = "nro: $cliente->nro_cliente - cuit: $cliente->cuit - nombre: $cliente->nombre_cliente";
                    }
                    ?>

                    <?php
                    echo '<label for="buscador-cliente" class="form-label">Buscar</label>';
                    echo Select2::widget([
                        'name' => 'buscador-cliente',
                        'data' => $data,
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Buscar por Cuit o Nombre',
//                                'multiple' => true
                        ],
                        'pluginEvents' => [
                            "select2:select" => "function() {  
                                     $.pjax.reload({
                                        push: false,
                                        replace: false,
                                        url: '/sitio/buscar-cliente',
                                        type: 'POST',
                                        data: $('#cliente-pedido-form').serialize(),
                                        container: '#pjax-pedido-cliente',
                                        timeout: false,
                                        async: false,
                                    })
                                  }",
                        ],
                        'pluginOptions' => [
                            'changeOnReset' => true,
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-pedido-cliente']) ?>

                    <?php
                    $js = " 
                        $('.limpiar-cliente').on('click',function(){
                                $.pjax.reload({
                                        push: false,
                                        replace: false,
                                        url: '/sitio/limpiar-cliente',
                                        type: 'POST',
                                        container: '#pjax-pedido-cliente',
                                        timeout: false,
                                        async: false,
                                    })
                        })
                            ";
                    $this->registerJs($js);
                    ?>




                    <?= $form->field($model, 'id_cliente')->hiddenInput()->label(false) ?>


                    <div class="form-group">
                        <label for="name" class="form-label">Cuit</label>
                        <!--<input id="name" type="text" class="form-control">-->
                        <?= $form->field($model, 'cuit')->textInput(['class' => 'form-control'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nro Cliente</label>
                        <!--<input id="name" type="text" class="form-control">-->
                        <?= $form->field($model, 'nro_cliente')->textInput(['class' => 'form-control'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre o Razón Social</label>
                        <!--<input id="name" type="text" class="form-control">-->
                        <?= $form->field($model, 'nombre_cliente')->textInput(['class' => 'form-control', 'id' => 'nombre-cliente-input'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <!--<input id="email" type="text" class="form-control">-->
                        <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control', 'id' => 'telefono-cliente-input'])->label(false) ?>

                    </div>
                    <div class="form-group">
                        <label for="mail_cliente" class="form-label">Mail</label>
                        <!--<input id="Usuario" type="Usuario" class="form-control">-->
                        <?= $form->field($model, 'mail_cliente')->textInput(['type' => 'email', 'class' => 'form-control', 'id' => 'email-cliente-input'])->label(false) ?>

                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Direccion Envio</label>
                        <!--<input id="name" type="text" class="form-control">-->
                        <?= $form->field($carrito, 'direccion_envio')->textInput(['class' => 'form-control'])->label(false) ?>
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
                            <button data-pjax="0" type="submit" formaction="<?= \yii\helpers\Url::to(['pedido-facturacion']) ?>" class="mt-2 mt-sm-0 btn btn-outline-secondary">

                                <p>ENVIAR POR MAIL</p> 

                            </button>
                            <button data-pjax="0"  type="submit" formaction="<?= \yii\helpers\Url::to(['imprimir-pedido']) ?>"  class="mt-2 mt-sm-0 btn btn-outline-secondary">

                                <p>Crear PDF</p> 

                            </button>
                            <div  data-pjax="0"    class="mt-2 mt-sm-0 btn btn-outline-secondary limpiar-cliente">

                                <p>Nuevo</p> 

                            </div>


                        </div>
                    </div>

                </div>
                <?php \yii\widgets\Pjax::end() ?>


                <?php \yii\widgets\ActiveForm::end(); ?>

            </div>

        </div>
    </section>
    <?php yii\bootstrap4\Modal::end();
    ?>
