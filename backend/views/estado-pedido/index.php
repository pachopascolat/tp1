
<?php
//    \backend\assets\BootstrapVueAsset::register($this);
//\backend\assets\VueAsset::register($this);
\backend\assets\AxiosAsset::register($this);

$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css",['position'=>$this::POS_HEAD]);
//$this->registerCssFile("//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver",['position'=>$this::POS_HEAD]);
//
$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js",['position'=>$this::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js",['position'=>$this::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/vue-lazyload/vue-lazyload.js",['position'=>$this::POS_HEAD]);
////$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js",['position'=>$this::POS_HEAD]);
//$this->registerJsFile("https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js",['position'=>$this::POS_HEAD]);



?>


<div id="app" class="pt-3">


    <div v-if="pedido">

        <b-modal size="lg" v-model="modalShow" id="modal-1" :title="'Pedido '+ pedido.id ">
            <div>
                <label>Estado: {{pedido.estado}}</label>
            </div>
            <div>
                <label>Deposito: {{pedido.des}}</label>
            </div>
            <div>
                <label>Fecha Emisión: {{pedido.fem}}</label>
            </div>
            <div>
                <label>Cliente: {{pedido.nombre}}</label>
            </div>
            <div>
                <label>Observaciones: {{pedido.obs}}</label>
            </div>
            <table class="table table-striped table-inverse table-bordered">
                <thead class="thead-inverse">
                <tr>
                    <th>Item Data</th>
                    <th>Codigo Articulo</th>
                    <th>Descripción Tela</th>
                    <th>Código Variante</th>
                    <th>Nombre Variante</th>
                    <th>Piezas pedidas</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <!--                    <template v-for="value,label in items[0]">-->
                    <!--                        <th>{{label}}</th>-->
                    <!--                    </template>-->
                </tr>
                </thead>
                <tbody>
                <template v-for="item,j in items">
                    <tr>
                        <td>
                            {{item.itemdata}}
                        </td>
                        <td>
                            {{item.articulo}}
                        </td>
                        <td>
                            {{item.art_desc}}
                        </td>
                        <td>
                            {{item.variante}}
                        </td>
                        <td>
                            {{item.var_desc}}
                        </td>
                        <td>
                            {{item.pza_ped}}
                        </td>
                        <td>
                            {{item.precio}}
                        </td>
                        <td>
                            <div>
                                <img ref="imagen"
                                >
                            </div>
                        </td>

                        <!--                        <template v-for="value,label in item">-->
                        <!--                            <td>-->
                        <!--                                <div v-html="value"></div>-->
                        <!---->
                        <!--                            </td>-->
                        <!--                        </template>-->
                    </tr>
                </template>
                </tbody>
            </table>
            <template>

            </template>
        </b-modal>
    </div>
    <h2>Estado Pedidos</h2>
    <table id="estado-pedido-table"  v-if="pedidos" class="table table-striped table-inverse table-bordered">
        <thead class="thead-inverse">
        <tr>
            <!--            <th>#</th>-->

            <th>Nro Estado</th>
            <th>Estado</th>
            <th>Deposito</th>
            <th>Cliente</th>
            <th>Fecha Emisión</th>
            <th>Nro</th>
            <th>Id</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha Cierre</th>
            <th>Fecha Factura</th>
            <th>Fecha Despacho</th>
            <th>Observaciones</th>
            <!--            <template v-for="(header,i) in pedidos[0]">-->
            <!--            <th>{{i}}</th>-->
            <!--            </template>-->
        </tr>
        </thead>
        <tbody>
        <template v-for="(pedido,i) in pedidos">
            <tr v-on:click="getItems(i,pedido.id)" >
                <template v-for="(data,i) in pedido">
                    <td>
                        {{data}}
                    </td>
                </template>
            </tr>

        </template>
        </tbody>
    </table>




</div>


<script>
    Vue.use(VueLazyload, {
        // preLoad: 1.3,
        // error: 'dist/error.png',
        loading: '../img2020/loading.gif',
        attempt: 2
    })

    var app = new Vue({
        el:'#app',
        data:{
            modalShow:false,
            pedido:{},
            photos:[],
            items:
                // null,
                [{"itemdata":3834,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4003            ","var_desc":"Flor de Lis f. natural                            ","pza_ped":1,"precio":"0.00"},{"itemdata":4478,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4037            ","var_desc":"ZigZag coral                                      ","pza_ped":1,"precio":"0.00"},{"itemdata":4480,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4039            ","var_desc":"ZigZag ladrillo                                   ","pza_ped":1,"precio":"0.00"},{"itemdata":4482,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4041            ","var_desc":"Guarda Pampa verde                                ","pza_ped":1,"precio":"0.00"},{"itemdata":5121,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4050            ","var_desc":"Rombos Malva                                      ","pza_ped":1,"precio":"0.00"},{"itemdata":5125,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4054            ","var_desc":"Chevron Lacre                                     ","pza_ped":1,"precio":"0.00"},{"itemdata":5127,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4056            ","var_desc":"Chevron Maiz                                      ","pza_ped":1,"precio":"0.00"}]
            ,
            pedidos:
            // null
                [{"est":5,"estado":"05-Pidiendo","lugar":4,"nombre":"TEXSIM","fem":"2020-06-12","nro":0,"id":78357,"ori":4,"des":1,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"TEXSIM","fem":"2020-06-19","nro":0,"id":78644,"ori":3,"des":1,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"TEXSIM","fem":"2020-06-22","nro":0,"id":78712,"ori":3,"des":5,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":5,"nombre":"TEXSIM","fem":"2020-06-23","nro":0,"id":78757,"ori":5,"des":3,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"nombre":"TEXSIM","fem":"2020-06-29","nro":0,"id":78966,"ori":4,"des":3,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"nombre":"TEXSIM","fem":"2020-06-29","nro":0,"id":78983,"ori":4,"des":3,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"nombre":"TEXSIM","fem":"2020-06-30","nro":0,"id":79068,"ori":4,"des":3,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV $700 SEDESPACHA"},{"est":5,"estado":"05-Pidiendo","lugar":4,"nombre":"ESTELA GARCIA","fem":"2020-07-06","nro":0,"id":79125,"ori":4,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":5,"nombre":"TEXSIM","fem":"2020-07-13","nro":0,"id":79311,"ori":5,"des":1,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"ZOBERMAN JOSÉ ANGEL","fem":"2020-07-14","nro":0,"id":79374,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"tme $140\r\ntmr $140\r\nrepxdocena $600\r\nhcro $180\r\npbe $750\r\ngOB $600\r\nmfl $150\r\ncorpr $420\r\nfinal. se despacha. \r\nte mando cosas de lavalle."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"MEMLITEX SA","fem":"2020-07-15","nro":0,"id":79409,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$630 final. transferencia previa. te mando 5 piezas de lavalle."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"TEXSIM","fem":"2020-07-15","nro":0,"id":79410,"ori":3,"des":1,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"JAMIS S.R.L.","fem":"2020-07-15","nro":0,"id":79411,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"btl $160 fv. paga y retira x local\r\ntoal $380"},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"DOTTA DIEGO ALBERTO","fem":"2020-07-15","nro":0,"id":79416,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$650 fv. se entrega en junin 459 el MARTES 21/07\r\n DE 9 A 13 HS."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"TEXTIL MM S.A.","fem":"2020-07-15","nro":0,"id":79422,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"PBE $700 \r\nHCRO $180\r\nFINAL. SE DESPACHA A CORDOBA. \r\nTE MANDO PIEZAS DE LAVALLE"},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"BAC TEXTIL S.R.L","fem":"2020-07-15","nro":0,"id":79425,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$750 FV. SE ENTREGA EN LAVALLE."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"FISCHOFF GONZALO JAVIER","fem":"2020-07-15","nro":0,"id":79432,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$700 fv. se despacha a bahia blanca."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"AGNETTI ANIBAL JORGE","fem":"2020-07-15","nro":0,"id":79439,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$750 fv."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"DALESANDRO MIGUEL ANGEL","fem":"2020-07-15","nro":0,"id":79441,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$750 fv."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"TELAS X METRO S.R.L.","fem":"2020-07-15","nro":0,"id":79443,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$110 final."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"VERNACI EMILIANO SERGIO","fem":"2020-07-15","nro":0,"id":79444,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$700 fv."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"JAIME SALEM","fem":"2020-07-15","nro":0,"id":79450,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV - \r\nENVIAR MAÑANA"},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"DITEXSA S.A.C.IF.I","fem":"2020-07-15","nro":0,"id":79451,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$140 mitad fv mitad final."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"BUBAS PATRICIA MARCELA","fem":"2020-07-15","nro":0,"id":79452,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"se agrega 2 silver de Aruba\r\n5 bultos al deposito"},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"TEXSIM","fem":"2020-07-16","nro":0,"id":79456,"ori":1,"des":3,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"MANET SOCIEDAD DE RESPONSABILIDAD LIMITADA","fem":"2020-07-16","nro":0,"id":79459,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"frzb 900\r\npll 600\r\nmfl2.4  150\r\nfv tranfiere y se embala al deposito"},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"TEXTIL TRIUNVIRATO SH","fem":"2020-07-16","nro":0,"id":79479,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$185 final."},{"est":5,"estado":"05-Pidiendo","lugar":1,"nombre":"LORENZO HNOS SRL","fem":"2020-07-16","nro":0,"id":79482,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$145 final. se entrega."},{"est":5,"estado":"05-Pidiendo","lugar":3,"nombre":"MASKOTA S.R.L","fem":"2020-07-16","nro":0,"id":79487,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$700 final."},{"est":10,"estado":"10-Cargando","lugar":5,"nombre":"CONSUMIDOR FINAL","fem":"2020-06-24","nro":0,"id":78810,"ori":5,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"J.A. UNIFORMES S.A.S.","fem":"2020-07-08","nro":0,"id":79229,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"TRPTS S.A.S.","fem":"2020-07-13","nro":0,"id":79268,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":1,"nombre":"DALESANDRO MIGUEL ANGEL","fem":"2020-07-13","nro":0,"id":79302,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$750 frz.\r\n$800 frzm\r\nfv. se despacha a amr del plata"},{"est":10,"estado":"10-Cargando","lugar":1,"nombre":"FEV TELAS SRL","fem":"2020-07-13","nro":0,"id":79310,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$700 final. se despacha a rosario. te mando la francia de lavalle."},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"CORNEJO RODRIGO MAURO","fem":"2020-07-13","nro":0,"id":79316,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$180 fv."},{"est":10,"estado":"10-Cargando","lugar":1,"nombre":"SCHUSTER JONATHAN GABRIEL","fem":"2020-07-14","nro":0,"id":79360,"ori":1,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$140 final. te mando 6 piezas de lavalle."},{"est":10,"estado":"10-Cargando","lugar":4,"nombre":"CONSUMIDOR FINAL","fem":"2020-07-15","nro":0,"id":79436,"ori":4,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"MARTI ABEL AURELIO","fem":"2020-07-15","nro":0,"id":79438,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV 140\r\nTRANSFIERE VA AL DEPOSITO\r\nEXPRESO SOLMAR"},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"SUSSI ALEJANDRO JOSE","fem":"2020-07-15","nro":0,"id":79445,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"nombre":"MARCOS MALDONADO","fem":"2020-07-16","nro":0,"id":79478,"ori":3,"des":0,"fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV 650"},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"STANCATI JUAN PABLO","fem":"2020-06-22","nro":0,"id":78671,"ori":0,"des":3,"fcierre":"2020-06-22T14:24:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"AGUILAR CHOQUE VIRGINIA","fem":"2020-07-08","nro":0,"id":79218,"ori":0,"des":3,"fcierre":"2020-07-08T15:13:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"AGUILAR CHOQUE VIRGINIA","fem":"2020-07-08","nro":0,"id":79219,"ori":3,"des":0,"fcierre":"2020-07-08T15:14:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"BLANCO SAN FRANCISCO","fem":"2020-07-14","nro":0,"id":79340,"ori":1,"des":0,"fcierre":"2020-07-14T18:29:00.000Z","ffactura":null,"fdespacho":null,"obs":"cambio por pieza fallada."},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"TEXSIM","fem":"2020-07-14","nro":0,"id":79349,"ori":3,"des":1,"fcierre":"2020-07-16T16:44:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"TEXSIM","fem":"2020-07-14","nro":0,"id":79361,"ori":3,"des":1,"fcierre":"2020-07-16T14:00:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"TEXSIM","fem":"2020-07-14","nro":0,"id":79376,"ori":3,"des":1,"fcierre":"2020-07-16T15:13:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"ROLESSE GROUP S.A.","fem":"2020-07-14","nro":0,"id":79383,"ori":1,"des":0,"fcierre":"2020-07-16T12:01:00.000Z","ffactura":null,"fdespacho":null,"obs":"$270 fv. te mando un mat gris de lavalle. retira el clinete por el deposito."},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"TEXSIM","fem":"2020-07-14","nro":0,"id":79384,"ori":3,"des":1,"fcierre":"2020-07-16T14:18:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":4,"nombre":"WILSON BALDERRAMA","fem":"2020-07-15","nro":0,"id":79392,"ori":4,"des":0,"fcierre":"2020-07-15T13:53:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":4,"nombre":"TEXSIM","fem":"2020-07-15","nro":0,"id":79405,"ori":3,"des":4,"fcierre":"2020-07-15T15:40:00.000Z","ffactura":null,"fdespacho":null,"obs":"ROLLOS PARA MARIANA  ( WILSON VALDERRAMA)"},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"TEXSIM","fem":"2020-07-15","nro":0,"id":79413,"ori":1,"des":3,"fcierre":"2020-07-15T19:12:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"TEXSIM","fem":"2020-07-15","nro":0,"id":79423,"ori":3,"des":1,"fcierre":"2020-07-16T16:42:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"AGUILAR CHOQUE VIRGINIA","fem":"2020-07-15","nro":0,"id":79424,"ori":0,"des":3,"fcierre":"2020-07-15T17:13:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"BARBARESI RAUL","fem":"2020-07-15","nro":0,"id":79437,"ori":0,"des":1,"fcierre":"2020-07-15T18:58:00.000Z","ffactura":null,"fdespacho":null,"obs":"ANULADO, SE REINGRESAN PARA N/C FACTURA 0005467 (23 DE JUNIO)"},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"ACCESORIOS UTILES S.R.L.","fem":"2020-07-15","nro":0,"id":79442,"ori":1,"des":0,"fcierre":"2020-07-16T16:30:00.000Z","ffactura":null,"fdespacho":null,"obs":"$700 final"},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"TEXSIM","fem":"2020-07-16","nro":0,"id":79453,"ori":4,"des":3,"fcierre":"2020-07-16T12:31:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"ZOBERMAN JOSÉ ANGEL","fem":"2020-07-16","nro":0,"id":79457,"ori":0,"des":3,"fcierre":"2020-07-16T12:49:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"Textil H.H. S.A.","fem":"2020-07-16","nro":0,"id":79461,"ori":0,"des":3,"fcierre":"2020-07-16T13:48:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"nombre":"ZOBERMAN JOSÉ ANGEL","fem":"2020-07-16","nro":0,"id":79466,"ori":0,"des":3,"fcierre":"2020-07-16T14:48:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"SASSON ELIAS GABRIEL","fem":"2020-07-16","nro":0,"id":79467,"ori":1,"des":0,"fcierre":"2020-07-16T14:46:00.000Z","ffactura":null,"fdespacho":null,"obs":"$135 final.retira por local."},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"MATERIALES MARTELLI","fem":"2020-07-16","nro":0,"id":79469,"ori":1,"des":0,"fcierre":"2020-07-16T16:28:00.000Z","ffactura":null,"fdespacho":null,"obs":"$150 fv. retira por deposito junto a las cuerinas."},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"DELTOM SA","fem":"2020-07-16","nro":0,"id":79471,"ori":0,"des":1,"fcierre":"2020-07-16T14:41:00.000Z","ffactura":null,"fdespacho":null,"obs":"PEDIDO ANULADO SE REINGRESA PARA n/c"},{"est":20,"estado":"20-Cerrado","lugar":1,"nombre":"DELTOM SA","fem":"2020-07-16","nro":0,"id":79473,"ori":1,"des":0,"fcierre":"2020-07-16T15:54:00.000Z","ffactura":null,"fdespacho":null,"obs":""}],
        },
        mounted(){
            // this.getPedidos();
        },
        methods:{
            getPhoto(item,key){
                var self = this;
                axios.get('/admin/estado-pedido/get-photo',{params:{codigo:item.articulo,variante:item.variante}})
                    .then(function (response) {
                        self.$refs.imagen[key].src = response.data;
                        console.log(response.data);
                        // return response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function (response) {
                        // console.log(response);
                        // always executed
                    });
            },
            getItems(key,id){
                var self = this;
                this.pedido = Object.create(this.pedidos[key]);

                // for(var i = 0 ; i < self.items.length; i++){
                //     self.getPhoto(self.items[i],i)
                // }
                // self.pedido['items'] = self.items;
                // self.modalShow = true;
                //
                // return;

                axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        self.items = response.data;
                        console.log(response.data);
                        for(var i = 0 ; i < self.items.length; i++){
                            self.getPhoto(self.items[i],i)
                        }
                        self.pedido['items'] = self.items;
                        self.modalShow = true;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getPedidos(){
                var self = this;
                axios.get('http://10.10.1.51:8000/pedidosEnCurso')
                    .then(function (response) {
                        self.pedidos = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            }

        }
    });
</script>

<style>

    #app td{
        font-size: 12px;
        padding-left: 2px;
        padding-right: 4px;
    }
    #app th{
        font-size: 14px;
        padding-left: 2px;
        padding-right: 4px;
    }

</style>
