
<style>
    .help-block{
        color: red;
    }
</style>



<?php
//echo $this->render('nav3_sin');


echo $this->render('cart', ['id_carrito' => $carrito->id_carrito]);
?>


<style>
    .lector{
        position: absolute;
        top:0;
        right:  50%;
        left: 50%;
        z-index: 10000;
    }
</style>

<div class="lector d-flex justify-content-center">
    <div id="lector-wrap" class="bg-light p-2 d-none">
        <div class="d-flex justify-content-end">
            <div class="pl-1 pr-1 bg-dark">
                <div class="close-lector">
                    <i class="text-light fal fa-times"></i>
                </div>
            </div>
        </div>
        <div>


            <div class="">
                <video class="" id="video" width="300" height="200" style="border: 1px solid gray"></video>
            </div>

            <div>
                <a class="btn btn-success" id="startButton">Start</a>
                <a class="btn btn-primary" id="resetButton">Reset</a>
            </div>

            <div id="sourceSelectPanel" style="display:none">
                <label for="sourceSelect">Change video source:</label>
                <select id="sourceSelect" style="max-width:400px">
                </select>
            </div>

            <!--            <label>Result:</label>
                        <pre><code id="result"></code></pre>-->
        </div>
    </div>
</div>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script type="text/javascript">

                    


                    window.addEventListener('load', function () {
                        let selectedDeviceId;
                        const codeReader = new ZXing.BrowserMultiFormatReader()
                        console.log('ZXing code reader initialized')
                        codeReader.getVideoInputDevices()
                                .then((videoInputDevices) => {
                                    const sourceSelect = document.getElementById('sourceSelect')
                                    selectedDeviceId = videoInputDevices[0].deviceId
                                    if (videoInputDevices.length >= 1) {
                                        videoInputDevices.forEach((element) => {
                                            const sourceOption = document.createElement('option')
                                            sourceOption.text = element.label
                                            sourceOption.value = element.deviceId
                                            sourceSelect.appendChild(sourceOption)
                                        })

                                        sourceSelect.onchange = () => {
                                            selectedDeviceId = sourceSelect.value;
                                        };

                                        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                                        sourceSelectPanel.style.display = 'block'
                                    }

                                    document.getElementById('startButton').addEventListener('click', () => {
                                        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                                            if (result) {
                                                codeReader.reset();
                                                console.log(result);
                                                agregarDesdeCodigo(result.text);
//                                                $.ajax({
//                                                    url: '/sitio/datos-codigo',
//                                                    type: 'POST',
//                                                    data: {code: result.text},
//                                                    success: function (e) {
//                                                        $('.carrito-count-div').each(function () {
//                                                            $(this).removeClass('d-none');
//                                                        });
//
//                                                        $('.carrito-count').each(function () {
//                                                            $(this).text(e);
//                                                        });
//                                                        consultaguardada();
//                                                        $.pjax.reload('#cart-pjax');
//                                                    }
//                                                });
//                                $.ajax({
//                                    url: "http://7633081eb66a.sn.mynetname.net:8000/rollo/" + result.text,
//                                    success: function (res) {
//                                        console.log(res);
//                                        document.getElementById('result').textContent = "tela " + res.articulo + " color: " + res.variante;
//                                        $.ajax({
//                                            type: 'POST',
//                                            url: "/sitio/agregar-desde-codigo",
//                                            data: {tela_id: res.articulo, color_id: res.variante},
//                                            success: function (e) {
//                                                $('.carrito-count-div').each(function () {
//                                                    $(this).removeClass('d-none');
//                                                });
//
//                                                $('.carrito-count').each(function () {
//                                                    $(this).text(e);
//                                                });
//                                                consultaguardada();
//                                                $.pjax.reload('#cart-pjax');
//                                            }
//                                        });
//                                    }
//                                })

//                                document.getElementById('result').textContent = result.text
                                            }
                                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                                console.error(err)
                                                document.getElementById('result').textContent = err
                                            }
                                        }
                                        )
                                        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
                                    })

                                    document.getElementById('resetButton').addEventListener('click', () => {
                                        codeReader.reset()
                                        document.getElementById('result').textContent = '';
                                        console.log('Reset.')
                                    })

                                })
                                .catch((err) => {
                                    console.error(err)
                                })
                    })
</script>


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
                                        <!--<hr>-->
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
<div id="pedido-facturacion" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $this->render('_clientePedido', ['model' => $model, 'carrito' => $carrito]); ?>
            </div>
        </div>
    </div>
</div>




