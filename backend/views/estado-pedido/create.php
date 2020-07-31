<?php
//    \backend\assets\BootstrapVueAsset::register($this);
//\backend\assets\VueAsset::register($this);
\backend\assets\AxiosAsset::register($this);

$this->registerCssFile("//unpkg.com/bootstrap/dist/css/bootstrap.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css",['position'=>$this::POS_HEAD]);
$this->registerCssFile("https://unpkg.com/vue-select@latest/dist/vue-select.css",['position'=>$this::POS_HEAD]);
//$this->registerCssFile("//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver",['position'=>$this::POS_HEAD]);
//
$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js",['position'=>$this::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js",['position'=>$this::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/vue-select@latest",['position'=>$this::POS_HEAD]);
////$this->registerJsFile("https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js",['position'=>$this::POS_HEAD]);
//$this->registerJsFile("https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js",['position'=>$this::POS_HEAD]);



?>

<div id="app" class="container">

    <div class="pt-2">
        <h2>Cliente</h2>
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


    </div>
    <hr>
    <div>
        <h3>Pedido</h3>
        <v-select @input="addItem(item.articulo)" placeholder="ingresar Item por codigo o nombre" @search="getTelas" :filterable="false"  v-model="item" :options="itemOptions"></v-select>
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
                <th>Piezas</th>
                <th>Precio</th>
                <th>Borrar</th>

            </tr>
            </thead>
            <tbody>
            <template v-for="(item,i) in pedido.items">
                <tr>
                    <td scope="row"></td>
                    <td>{{item.tela.codigo_tela}}</td>
                    <td>{{item.tela.nombre_tela}}</td>
                    <td>{{item.codigo_color}}</td>
                    <td>{{item.nombre_color}}</td>
                    <td><input v-model="items.piezas" class="form-control"></td>
                    <td><input v-model="item.precio" class="form-control"></td>
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

    Vue.component('v-select', VueSelect.VueSelect);

    var app = new Vue({
        el:'#app',
        data:{
            pedido:{items:[],rempeds:[]},
            items:[],
            item:null,
            itemForm:null,
            itemOptions:[],
            cliente:null,
            options:[],
        },
        mounted(){
            if (localStorage.getItem('items')) {
                try {
                    this.pedido.items = JSON.parse(localStorage.getItem('items'));
                } catch(e) {
                    localStorage.removeItem('items');
                }
            }
        },
        methods:{
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
            saveItems(){
                const parsed = JSON.stringify(this.pedido.items);
                localStorage.setItem('items', parsed);
            },
            delItem(key){
                this.pedido.items.splice(key,1);
                this.saveItems();
            },
            addItem(){
                this.item.articulo['piezas']=0;
                this.item.articulo['precio']=0;
                this.pedido.items.push(this.item.articulo);
                this.item = {};
                this.saveItems();
            },
            getTelas(search,loading){
                loading(true);
                var self = this;
                axios.get('/admin/estado-pedido/buscar-telas?search='+search)
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        console.log(response.data);
                        self.itemOptions = response.data;
                        // self.options = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
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
                        // self.options = response.data;
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
