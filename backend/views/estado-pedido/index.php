
<?php
\backend\assets\BackendAsset::register($this);




?>
<?=  $this->render('Components/Romaneo');?>
<?=  $this->render('Components/Pedido');?>

<div id="app" class="pt-3">


    <b-modal v-model="showRomaneo" size="lg" id="modal-1" :title="'Items Pedido: '+pedido.id">
        <romaneo :items="items"></romaneo>
    </b-modal>
    <b-modal v-model="showPedido" size="lg" id="modal-2" :title="'Pedido: '+pedido.id">
        <pedido :pedido="pedido" :labels="modalLabels"></pedido>
    </b-modal>



    <h3>Estado Pedidos</h3>
    <div class="p-1 d-flex">
<!--        <a name="" id="" class="btn btn-primary btn-sm p-1" href="--><?//=\yii\helpers\Url::to(['estado-pedido/crear-pedido'])?><!--" role="button">Nuevo</a>-->
        <a name="" id="" class="btn btn-danger btn-sm p-1" href="<?=\yii\helpers\Url::to(['/chart/index'])?>" role="button">Stock</a>
    </div>
    <table id="estado-pedido-table"  v-if="pedidos" class="table table-striped table-inverse table-bordered">
        <thead class="thead-inverse">
        <tr>
            <template v-for="item in tableLabels">
                <th :class="!item.movil?'d-none d-md-table-cell':''" v-if="item.visible">{{item.label}}</th>
            </template>
            <th class="estado"><span>Preparacion</span></th>
            <th class="estado"><span>Facturacion</span></th>
            <th class="estado"><span>Autorizacion-Pago</span></th>
            <th class="estado"><span>Entrega</span></th>
        </tr>
        </thead>
        <tbody>
        <template v-for="(pedido,i) in pedidos">
            <tr  >
                <template v-for="item,i in tableLabels">
                    <td :class="!item.movil?'d-none d-md-table-cell':''" v-if="item.visible" v-on:click="showPedidoData(pedido)">{{pedido[item.field]}}</td>
                </template>
                <template class="progressbar-wrapper">
                    <td class="estado">
                        <div class="progressbar">
                            <div v-on:click="getItems(i,pedido.id)" :class="pedido.est>=20?'active':''"></div>
                        </div>
                    </td>
                    <td class="estado">
                        <div class="progressbar">
                            <div v-on:click="getItems(i,pedido.id)" :class="pedido.est>=30?'active':''"></div>
                        </div>
                    </td>
                    <td class="estado">
                        <div class="progressbar">
                            <div :class="pedido.est>=40?'active':''"></div>
                        </div>
                    </td>
                    <td class="estado">
                        <div class="progressbar">
                            <div :class="pedido.est>=50?'active':''"></div>
                        </div>
                    </td>
                </template>
            </tr>

        </template>
        </tbody>
    </table>




</div>


<script>



    var app = new Vue({
        el:'#app',
        components:{
            romaneo: Romaneo,
            pedido: Pedido,
            // 'b-model':BModal,
        },
        data:{
            tableLabels:[
                {field:'id',label:'Id Pedido',visible:true,movil:true},
                {field:'user',label:'Usuario',visible:true,movil:true},
                {field:'fem',label:'Fecha Emision',visible:true,movil:false},
                {field:'depo_nom',label:'Deposito',visible:true,movil:false},
                {field:'nombre',label:'Cliente',visible:true,movil:true},
                {field:'est',label:'Nro Estado',visible:true,movil:true},
                {field:'estado',label:'Descripcion Estado',visible:true,movil:false},
                {field:'des',label:'Destino?',visible:false,movil:false},
                {field:'fcierre',label:'Fecha Cierre',visible:false,movil:false},
                {field:'fdespacho',label:'Fecha Despacho',visible:false,movil:false},
                {field:'ffactura',label:'Fecha Factura',visible:false,movil:false},
                {field:'lugar',label:'Lugar',visible:false,movil:false},
                {field:'nro',label:'Numero',visible:false,movil:false},
                {field:'obs',label:'Observaciones',visible:false,movil:false},
                {field:'ori',label:'Origen',visible:false,movil:false},
            ],
            modalLabels:[
                {field:'id',label:'Id Pedido',visible:true},
                {field:'user',label:'Usuario',visible:true},
                {field:'fem',label:'Fecha Emision',visible:true},
                {field:'depo_nom',label:'Deposito',visible:true},
                {field:'nombre',label:'Cliente',visible:true},
                {field:'est',label:'Nro Estado',visible:true},
                {field:'estado',label:'Descripcion Estado',visible:true},
                {field:'des',label:'Destino?',visible:true},
                {field:'fcierre',label:'Fecha Cierre',visible:true},
                {field:'fdespacho',label:'Fecha Despacho',visible:true},
                {field:'ffactura',label:'Fecha Factura',visible:true},
                {field:'lugar',label:'Lugar',visible:true},
                {field:'nro',label:'Numero',visible:true},
                {field:'obs',label:'Observaciones',visible:true},
                {field:'ori',label:'Origen',visible:true},
            ],
            showRomaneo:false,
            showPedido:false,
            pedido:{},
            photos:[],
            items:
            null
            //     [{"itemdata":3834,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4003            ","var_desc":"Flor de Lis f. natural                            ","pza_ped":1,"precio":"0.00"},{"itemdata":4478,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4037            ","var_desc":"ZigZag coral                                      ","pza_ped":1,"precio":"0.00"},{"itemdata":4480,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4039            ","var_desc":"ZigZag ladrillo                                   ","pza_ped":1,"precio":"0.00"},{"itemdata":4482,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4041            ","var_desc":"Guarda Pampa verde                                ","pza_ped":1,"precio":"0.00"},{"itemdata":5121,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4050            ","var_desc":"Rombos Malva                                      ","pza_ped":1,"precio":"0.00"},{"itemdata":5125,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4054            ","var_desc":"Chevron Lacre                                     ","pza_ped":1,"precio":"0.00"},{"itemdata":5127,"articulo":"GOB3000         ","art_desc":"Gobelino                                          ","variante":"4056            ","var_desc":"Chevron Maiz                                      ","pza_ped":1,"precio":"0.00"}]
            ,
            pedidos:
            null
            //     [{"est":10,"estado":"10-Cargando","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-06-12","nro":0,"id":78357,"ori":4,"des":1,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":5,"depo_nom":"AZCUENGA 580","nombre":"TEXSIM","fem":"2020-06-23","nro":0,"id":78757,"ori":5,"des":3,"user":"Mostrador","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-06-29","nro":0,"id":78966,"ori":4,"des":3,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-06-29","nro":0,"id":78983,"ori":4,"des":3,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-06-30","nro":0,"id":79068,"ori":4,"des":3,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV $700 SEDESPACHA"},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"ESTELA GARCIA","fem":"2020-07-06","nro":0,"id":79125,"ori":4,"des":0,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":5,"depo_nom":"AZCUENGA 580","nombre":"TEXSIM","fem":"2020-07-13","nro":0,"id":79311,"ori":5,"des":1,"user":"Mostrador","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":4,"depo_nom":"CELINA","nombre":"WILSON BALDERRAMA","fem":"2020-07-15","nro":0,"id":79392,"ori":4,"des":0,"user":"Hernan","fcierre":"2020-07-15T13:53:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-07-15","nro":0,"id":79405,"ori":3,"des":4,"user":"Hernan","fcierre":"2020-07-15T15:40:00.000Z","ffactura":null,"fdespacho":null,"obs":"ROLLOS PARA MARIANA  ( WILSON VALDERRAMA)"},{"est":20,"estado":"20-Cerrado","lugar":4,"depo_nom":"CELINA","nombre":"CONSUMIDOR FINAL","fem":"2020-07-17","nro":0,"id":79556,"ori":4,"des":0,"user":"Hernan","fcierre":"2020-07-17T18:12:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"depo_nom":"LAVALLE","nombre":"THE VOX S.R.L.","fem":"2020-07-17","nro":0,"id":79589,"ori":0,"des":3,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"TEXSIM","fem":"2020-07-22","nro":0,"id":79766,"ori":3,"des":1,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"","fem":"2020-07-23","nro":0,"id":79830,"ori":4,"des":0,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"QUISPE LAURA SALTA ASUNTA","fem":"2020-07-27","nro":0,"id":79912,"ori":0,"des":4,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"TEXSIM","fem":"2020-07-27","nro":0,"id":79919,"ori":3,"des":1,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-07-29","nro":0,"id":80074,"ori":4,"des":3,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":4,"depo_nom":"CELINA","nombre":"HERNAN TITO","fem":"2020-07-30","nro":0,"id":80117,"ori":4,"des":0,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"TEXSIM","fem":"2020-07-31","nro":0,"id":80208,"ori":4,"des":3,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"MISHAGUI BLANCO S.R.L.","fem":"2020-08-04","nro":0,"id":80321,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FINAL $150 TRANSFIERE Y RETIRA.\r\n\r\nENTREGA 3"},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"MISHAGUI BLANCO S.R.L.","fem":"2020-08-04","nro":0,"id":80322,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FINAL $150 TRANSFIERE Y RETIRA POR LAVALLE\r\n\r\nENTREGA 4"},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"MISHAGUI BLANCO S.R.L.","fem":"2020-08-04","nro":0,"id":80323,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FINAL $150 TRANSFIERE Y RETIRA.\r\n\r\nENTREGA 5"},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"ESTELA CHOQUE","fem":"2020-08-05","nro":0,"id":80365,"ori":4,"des":0,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"","fem":"2020-08-06","nro":0,"id":80403,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"depo_nom":"LAVALLE","nombre":"CONSUMIDOR FINAL","fem":"2020-08-06","nro":0,"id":80446,"ori":3,"des":0,"user":"Gabriela","fcierre":"2020-08-06T18:10:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":3,"depo_nom":"LAVALLE","nombre":"TEXSIM","fem":"2020-08-07","nro":0,"id":80507,"ori":1,"des":3,"user":"Gabriela","fcierre":"2020-08-07T16:20:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"SCHEEL KEVIN GEORGE","fem":"2020-08-07","nro":0,"id":80525,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"FV $600  PAGA Y RETIRA POR LAVALLE,LUNES."},{"est":20,"estado":"20-Cerrado","lugar":3,"depo_nom":"LAVALLE","nombre":"TEXSIM","fem":"2020-08-07","nro":0,"id":80544,"ori":5,"des":3,"user":"Gabriela","fcierre":"2020-08-07T19:02:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":10,"estado":"10-Cargando","lugar":3,"depo_nom":"LAVALLE","nombre":"TRPTS S.A.S.","fem":"2020-08-10","nro":0,"id":80576,"ori":0,"des":3,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"MISHAGUI BLANCO S.R.L.","fem":"2020-08-10","nro":0,"id":80584,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"150 final tranfiere\r\n\r\nPedido n 2"},{"est":10,"estado":"10-Cargando","lugar":3,"depo_nom":"LAVALLE","nombre":"SCHEEL KEVIN GEORGE","fem":"2020-08-10","nro":0,"id":80592,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"depo_nom":"DEPOSITO","nombre":"BUBAS PATRICIA MARCELA","fem":"2020-08-10","nro":0,"id":80600,"ori":1,"des":0,"user":"Admin","fcierre":"2020-08-10T19:31:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"MYRIAM ESPINOLA","fem":"2020-08-11","nro":0,"id":80646,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"HULE CON FRISELINA 130  CRISTAL ESTAMPADO 90   CRISTAL DE 10  80  CRISTAL DE 20  120   fv retira x lavalle mañana y paga en efectivo"},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"GERBER LORENA VALERIA","fem":"2020-08-11","nro":0,"id":80647,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"crt0010  80   crt0015   100    crt0020    120  final transfiere y se despacha\r\ncre 90"},{"est":20,"estado":"20-Cerrado","lugar":4,"depo_nom":"CELINA","nombre":"ANTONIO PACO","fem":"2020-08-12","nro":0,"id":80682,"ori":4,"des":0,"user":"Hernan","fcierre":"2020-08-13T18:26:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"SOUSSE´S S.R.L.","fem":"2020-08-12","nro":0,"id":80683,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"HARARI EZEQUIEL ANDRES Y HARARI REGINA INES","fem":"2020-08-12","nro":0,"id":80702,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$700 final. se despacha a rosario.,"},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"BLANCO CLAUDIO´S SA","fem":"2020-08-12","nro":0,"id":80706,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"525 docenas x $650 final. \r\nSe entrega en Directorio 7146."},{"est":20,"estado":"20-Cerrado","lugar":3,"depo_nom":"LAVALLE","nombre":"LOPEZ VANESA","fem":"2020-08-12","nro":0,"id":80714,"ori":0,"des":3,"user":"Gabriela","fcierre":"2020-08-12T20:51:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"JUGUETECH SA","fem":"2020-08-12","nro":0,"id":80716,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$45 final. retira por local."},{"est":20,"estado":"20-Cerrado","lugar":3,"depo_nom":"LAVALLE","nombre":"GREGO ROSA MARTA","fem":"2020-08-13","nro":0,"id":80725,"ori":3,"des":0,"user":"Gabriela","fcierre":"2020-08-13T15:45:00.000Z","ffactura":null,"fdespacho":null,"obs":"$135 FV. RETIRA POR LOCAL."},{"est":20,"estado":"20-Cerrado","lugar":1,"depo_nom":"DEPOSITO","nombre":"EL ASSIR ELIAS RUBEN","fem":"2020-08-13","nro":0,"id":80747,"ori":1,"des":0,"user":"Admin","fcierre":"2020-08-13T20:48:00.000Z","ffactura":null,"fdespacho":null,"obs":"$450 final. retira por deposito."},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"EL ASSIR ELIAS RUBEN","fem":"2020-08-13","nro":0,"id":80748,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$450 final."},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"DITEXSA S.A.C.IF.I","fem":"2020-08-13","nro":0,"id":80751,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$580 final."},{"est":5,"estado":"05-Pidiendo","lugar":4,"depo_nom":"CELINA","nombre":"","fem":"2020-08-13","nro":0,"id":80757,"ori":4,"des":0,"user":"Hernan","fcierre":null,"ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"depo_nom":"DEPOSITO","nombre":"BLANCO SAN FRANCISCO","fem":"2020-08-13","nro":0,"id":80760,"ori":1,"des":0,"user":"Admin","fcierre":"2020-08-13T21:27:00.000Z","ffactura":null,"fdespacho":null,"obs":"$140 final. se entrega en scalabrini ortiz."},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"TEXTIL UNION","fem":"2020-08-13","nro":0,"id":80761,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$45 final. se entrega en lavalle 2496."},{"est":20,"estado":"20-Cerrado","lugar":4,"depo_nom":"CELINA","nombre":"RICHARD FLORES","fem":"2020-08-13","nro":0,"id":80764,"ori":4,"des":0,"user":"Hernan","fcierre":"2020-08-13T18:44:00.000Z","ffactura":null,"fdespacho":null,"obs":""},{"est":20,"estado":"20-Cerrado","lugar":1,"depo_nom":"DEPOSITO","nombre":"HAAG ESTELLA MARIS","fem":"2020-08-13","nro":0,"id":80765,"ori":1,"des":0,"user":"Admin","fcierre":"2020-08-13T21:23:00.000Z","ffactura":null,"fdespacho":null,"obs":"FINAL MICRO 2.40 $ 150 CRISTAL 0.20 $ 120 TRANSFIERE Y SE DESPACHA."},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"OSORIO VICTOR DAVID","fem":"2020-08-13","nro":0,"id":80772,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$450 final"},{"est":5,"estado":"05-Pidiendo","lugar":3,"depo_nom":"LAVALLE","nombre":"GREGO ROSA MARTA","fem":"2020-08-13","nro":0,"id":80773,"ori":3,"des":0,"user":"Gabriela","fcierre":null,"ffactura":null,"fdespacho":null,"obs":"$135 fv. retira por local."}]
            }
        ,
        mounted(){
            this.getPedidos();
        },
        methods:{
            showPedidoData(pedido){
                this.pedido = pedido;
                this.showPedido = true;
            },
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

                axios.get('/admin/estado-pedido/pedidos-items/?id='+id)
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        self.items = response.data;
                        console.log(response.data);
                        for(var i = 0 ; i < self.items.length; i++){
                            self.getPhoto(self.items[i],i)
                        }
                        self.pedido['items'] = self.items;
                        self.showRomaneo = true;
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
                axios.get('/admin/estado-pedido/pedidos-en-curso')
                    // axios.get('http://10.10.1.51:8000/pedidosEnCurso')
                    .then(function (response) {
                        console.log(response);
                        self.pedidos = response.data.reverse();
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
*

    .estado{
        max-width: 80px;
        word-break: break-word;

    }



    #app td{
        /*font-size: 14px;*/
        /*padding: 2px 2px;*/
        vertical-align: middle;
    }


    .items-table td, .items-table th{
        font-size: 12px !important;
        padding-left: 2px;
        padding-right: 4px;
        vertical-align:middle;
    }


    .progressbar-wrapper {
        /*background: #fff;*/
        /*width: 100%;*/
        padding-top: 4px;
        padding-bottom: 2px;
    }


    ul.progressbar{
        padding-left: 0;
        d-flex;
        justify-content: center;
    }

    .progressbar div {
        overflow-wrap: break-word;
        list-style-type: none;
        width: 100%;
        float: left;
        font-size: 10px;
        position: relative;
        text-align: center;
        text-transform: uppercase;
        color: #7d7d7d;
    }

    .progressbar div:before {
        width: 30px;
        height: 30px;
        /*content: '';*/
        line-height: 30px;
        border: 2px solid #7d7d7d;
        display: block;
        text-align: center;
        margin: 0 auto  ;
        border-radius: 50%;
        position: relative;
        z-index: 2;
        background-color: #fff;
    }
    .progressbar div:after {
        width: 100%;
        height: 2px;
        content: '';
        position: absolute;
        background-color: #7d7d7d;
        top: 15px;
        left: -50%;
        z-index: 0;
    }
    .progressbar div:first-child:after {
        content: none;
    }

    .progressbar div.active {
        color: green;
        font-weight: bold;
    }
    .progressbar div.active:before {
        /*border-color: #55b776;*/
        /*border-color: white;*/
        border: 2px solid #fff;
        background: green;
        box-shadow: 0 0 0 2px #3cb371;
        content: '\2714';
        color: #fff3cd !important;
        line-height: 28px;
    }
    .progressbar div.active + div:after {
        background-color: #55b776;
    }

    /*.progressbar li.active:before {*/
    /*    background: #55b776  url(user.svg) no-repeat center center;*/
    /*    background-size: 60%;*/
    /*}*/
    /*.progressbar li::before {*/
    /*    background: #fff url(user.svg) no-repeat center center;*/
    /*    background-size: 60%;*/
    /*}*/
    .progressbar {
        counter-reset: step;
    }
    .progressbar div:before {
        /*content: counter(step);*/
        content: 'x';
        counter-increment: step;
        line-height: 28px;
    }




    .item-image{
        width:60px;
    }


    #app td, #app th{
        font-size: 10px;
        padding: 2px 2px;
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (min-width: 576px) {

        /*#app td, #app th {*/
        /*    font-size: 10px !important;*/
        /*}*/

    }

    /* Medium devices (tablets, 768px and up) The navbar toggle appears at this breakpoint */
    @media (min-width: 768px) {

        #app td, #app th {
            font-size: 12px !important;
            padding-left: 1em;
            padding-right: 1em;
        }

    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .item-image{
            width:100%;
        }
    }

    /* Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {

    }



    /*
    ::::::::::::::::::::::::::::::::::::::::::::::::::::
    Custom media queries
    */

    /* Set width to make card deck cards 100% width */
    @media (max-width: 950px) {

    }



</style>
