<?php
\backend\assets\BackendAsset::register($this);
//\backend\assets\VueAsset::register($this);
//\backend\assets\AxiosAsset::register($this);

//$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
//$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css",['position'=>$this::POS_HEAD]);
//$this->registerCssFile("//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver",['position'=>$this::POS_BEGIN]);
//
//$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js",['position'=>$this::POS_HEAD]);
//$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js",['position'=>$this::POS_HEAD]);
//$this->registerJsFile("https://unpkg.com/vue-select@latest",['position'=>$this::POS_HEAD]);
//$this->registerCssFile("https://unpkg.com/vue-select@latest/dist/vue-select.css",['position'=>$this::POS_HEAD]);

////$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js",['position'=>$this::POS_HEAD]);
//$this->registerJsFile("https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js",['position'=>$this::POS_HEAD]);



?>

<div id="app" class="container">
    <div class="p-3">
        <b-button v-b-toggle.collapse-1 variant="primary">Cliente</b-button>
        <h5 v-if="cliente">{{cliente.nombre}}</h5>
        <b-collapse id="collapse-1" class="mt-2">
            <b-card>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <v-select @input="selectCliente"  placeholder="ingresar Cliente por Codigo, Cuit o Nombre" @search="getClientes" :filterable="false"  v-model="cliente" :options="options"></v-select>
                        </div>

                        <div class="form-group">
                            <input placeholder="ingrese deposito" class="form-control" v-model="pedido.lugar">
                        </div>
                        <div class="form-group">
                            <!--                    <label for="example-datepicker">Ingrese fecha</label>-->
                            <b-form-datepicker id="example-datepicker" v-model="pedido.fem" class="mb-2"></b-form-datepicker>
                            <!--                    <p>Valor: '{{ pedido.fem }}'</p>-->
                            <!--                    <input :value="getDate" placeholder="ingrese Fecha Emisión" class="form-control" v-model="pedido.fem">-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="ingrese Dirección" class="form-control" v-model="pedido.direccion">
                        </div>
                        <div class="form-group">
                            <input placeholder="ingrese localidad" class="form-control" v-model="pedido.localidad">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="ingrese Observaciones" class="form-control" v-model="pedido.obs"></textarea>
                        </div>
                    </div>
                    <div></div>
                </div>
            </b-card>
        </b-collapse>
    </div>


    <hr>
    <div>
        <h3>Pedido</h3>
        <div v-if="articulos" class="form-group">
            <v-select  @input="getVariantes"  placeholder="Seleccione Articulo"    v-model="articulo" :options="articulos"></v-select>
        </div>

        <div  v-if="variantes" class="form-group">
            <v-select  @input="addItem"  placeholder="Seleccione Variante"  v-model="articulo.variante" :options="variantes"></v-select>
        </div>
    </div>
    <div>
        <table class="table table-striped table-inverse">
            <thead class="thead-inverse">
            <tr>
                <th>Imagen</th>
                <!--                <th>Item Data</th>-->
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Codigo Variante</th>
                <th>Nombre Variante</th>
                <th>Deposito</th>
                <th>Deposito</th>
                <th>Piezas</th>
                <th>Precio</th>
                <th>Borrar</th>

            </tr>
            </thead>
            <tbody>
            <template v-for="(item,i) in pedido.items">
                <tr>
                    <td scope="row">
                        <img class="img-item" :src="item.url">
                    </td>
                    <td>{{item.articulo}}</td>
                    <td>{{item.nom}}</td>
                    <td>{{item.variante.variante}}</td>
                    <td>{{item.variante.nom}}</td>
                    <td v-for="dep in item.depositos"  class="text-nowrap">
                        {{dep.nombre}}: {{dep.piezas}}piezas - {{dep.mts}}MTS
                    </td>
                    <td>
                        <select v-if="item.depositos" v-model="pedido.deposito" class="form-control form-control-sm">
                            <option v-for="dep in item.depositos">
                            <span>
                                {{dep.nombre}}: {{dep.piezas}}piezas - {{dep.mts}}MTS
                            </span>
                            </option>
                        </select>

                    </td>

                    <td><input v-model="item.piezas" class="form-control items-input form-control-sm"></td>
                    <td><input v-model="item.precio" class="form-control items-input form-control-sm"></td>
                    <td>
                        <button @click="delItem(i)" type="button" class="btn btn-danger">borrar</button>
                    </td>
                </tr>
            </template>

            </tbody>
        </table>
    </div>
    <div>
        <button @click="guardarPedido" type="button" class="btn btn-success">Guardar</button>
    </div>

</div>

<script>

    // Vue.component('v-select', VueSelect.VueSelect);

    var app = new Vue({
        el:'#app',
        components:{
            'v-select':VueSelect.VueSelect,
        },
        data:{
            depositos:[
                {nro:1,piezas:0,mts:0,nombre:'Deposito'},
                {nro:2,piezas:0,mts:0,nombre:'Deposito 2'},
                {nro:3,piezas:0,mts:0,nombre:'Lavalle'},
                {nro:4,piezas:0,mts:0,nombre:'Celina'},
                {nro:5,piezas:0,mts:0,nombre:'Azcuenaga'},
            ],
            variantes:null,
            variante:{},
            articulo:null,
            articulos:null,
            pedido:{items:[]},
            cliente:null,
            options:[],
        },
        mounted(){
            this.getStock();
            // if (localStorage.getItem('items')) {
            //     try {
            //         this.pedido.items = JSON.parse(localStorage.getItem('items'));
            //     } catch(e) {
            //         localStorage.removeItem('items');
            //     }
            // }
        },
        methods:{
            // getDepositos(){
            //     for(var i = 1; i < 6 ; i++){
            //        this.getPorDeposito(i);
            //     }
            //     console.log('termine el for de getDeposito');
            //     // this.articulo.depositos = this.depositos;
            //     // this.saveItems();
            //     // this.articulo={};
            // },
            getDepositos(deposito){
                var self = this;
                var url = '/admin/chart/get-depositos?deposito='+deposito+'&articulo='+self.articulo.articulo;
                if(self.articulo.variante){
                    url = '/admin/chart/get-depositos?deposito='+deposito+'&articulo='+self.articulo.articulo+'&variante='+self.articulo.variante.variante;
                }
                // self.loading = true;
                axios.get(url)
                    .then(function (response) {
                        console.log(response.data);
                        if(response.data) {
                            self.articulo.depositos = response.data;
                        }
                        self.articulo['piezas']=0;
                        self.articulo['precio']=0;
                        self.pedido.items.push(self.articulo);
                        self.saveItems();
                        self.articulo = {};
                        self.variantes = null;

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                    });
            },
            normalizeArticulos(){
                for(var i = 0 ; i < this.articulos.length; i++){
                    this.articulos[i].label = this.articulos[i].articulo + ' - ' +  this.articulos[i].nom;
                }
            },
            normalizeVariantes(){
                for(var i = 0 ; i < this.variantes.length; i++){
                    this.variantes[i].label = this.variantes[i].variante + ' - ' +  this.variantes[i].nom;
                }
            },
            getPhoto(){
                var self = this;
                axios.get('/admin/estado-pedido/get-photo?codigo='+self.articulo.articulo+'&variante='+parseInt(self.articulo.variante.variante))
                    .then(function (response) {
                        console.log('entre en getPhoto');
                        self.articulo.url = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getVariantes: function(){
                this.variantes = null;
                var self = this;
                axios.get('/admin/chart/get-variantes/?articulo='+self.articulo.articulo)
                    .then(function (response) {
                        self.variantes = response.data;
                        self.normalizeVariantes();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getStock: function(page){
                var self = this;
                axios.get('/admin/chart/get-articulos')
                    .then(function (response) {
                        self.articulos = response.data;
                        self.todosArticulos = response.data;
                        self.normalizeArticulos();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                    });
            },
            clearPedido(){
                this.pedido = {};
                this.saveItems();
            },
            selectCliente(){
                if(this.cliente) {
                    this.pedido.idCliente = this.cliente.code;
                    this.pedido.nombre = this.cliente.cliente.nom;
                }else{
                    this.clearCliente();
                }
            },
            clearCliente(){
                this.pedido.idCliente = null;
                this.pedido.nombre = null;
            },
            clearItems(){
                localStorage.removeItem('items');
            },
            saveItems(){
                const parsed = JSON.stringify(this.pedido.items);
                localStorage.setItem('items', parsed);
            },
            delItem(key){
                this.pedido.items.splice(key,1);
                this.saveItems();
            },
            addItem(){
                this.getPhoto();
                this.getDepositos();
            },
            getTelas(search,loading){
                loading(true);
                var self = this;
                axios.get('/admin/chart/buscar-telas?search='+search)
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        console.log(response.data);
                        self.itemOptions = response.data;
                        // self.options = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                        loading(false);
                    });
            },
            getClientes(search,loading){
                loading(true);
                var self = this;
                axios.get('/admin/estado-pedido/buscar-cliente?textsearch='+search)
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        console.log(response.data);
                        self.normalizarClientes(response.data);
                        // self.options = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                        loading(false);
                    });
            },
            normalizarClientes(data){
                var options = []
                for (i in data){
                    options.push({
                        cliente: data[i],
                        code:data[i].codfac,
                        label: "codigo:"+data[i].codfac+"-cuit:"+data[i].cuit+"-"+data[i].nom
                    })
                }
                this.options = options
            },
            guardarPedido(){
                var self = this;
                axios.get('/admin/estado-pedido/guardar-pedido?',{params:{pedido:self.pedido}})
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        console.log(response.data);
                        self.pedido = {};
                        self.clearItems();

                        // self.options = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        location.reload();
                    })
                    .then(function () {
                        // always executed
                    });
            }
        }
    });
</script>
<style>
    table{
        font-size: 10px;
    }
    .items-input{
        width:50px;
    }
    .img-item{
        width:50px;
    }
</style>
