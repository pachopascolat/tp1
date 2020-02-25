<div id="pedido-simple" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <section>
                    <div class="p-4">
                        <div class="">

                            <div class="">
                                <div class="block">

                                    <h6 class="btn-title  btn-dark " >Tus Datos</h6>

                                    <div class="block-body"> 

                                        <?php
                                        $form = \yii\widgets\ActiveForm::begin([
//                                                    'enableAjaxValidation' => true,
                                        ]);
                                        ?>
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre o Razón Social</label>
                                            <?= $form->field($model, 'nombre_cliente')->textInput(['class' => 'form-control'])->label(false) ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <?= $form->field($model, 'telefono')->textInput(['class' => 'form-control'])->label(false) ?>

                                        </div>
                                        <div class="form-group">
                                            <label for="mail_cliente" class="form-label">Mail</label>
                                            <?= $form->field($model, 'mail_cliente')->textInput(['class' => 'form-control'])->label(false) ?>

                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between flex-column flex-lg-row loading-div mt-4">

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn-pedido btn btn-outline-secondary">
                                                    <i class="fal fa-envelope" aria-hidden="true"></i>
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    <span class="sr-only">Loading...</span>
                                                    <p>ENVIAR POR MAIL</p> 
                                                </button>


                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" formaction="<?php echo \yii\helpers\Url::to(['crear-consulta-whats-app']) ?>" id="consulta-whatsapp" type="" class="btn-pedido btn btn-outline-secondary">
                                                    <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    <span class="sr-only">Loading...</span>
                                                    <p>ENVIAR POR WHATSAPP</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <?php \yii\widgets\ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>