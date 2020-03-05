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