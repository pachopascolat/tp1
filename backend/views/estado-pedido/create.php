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

<div id="app">

    <div>
        <v-select @search="getClientes" :filterable="false"  v-model="textsearch" :options="options"></v-select>
    </div>

</div>

<script>

    Vue.component('v-select', VueSelect.VueSelect);

    var app = new Vue({
        el:'#app',
        data:{
            textsearch:"",
            options:['hola','mundo'],
        },
        methods:{
            getClientes(search,loading){
                loading(true);
                var self = this;
                axios.get('/admin/estado-pedido/buscar-cliente?textsearch='+search)
                    // axios.get('http://10.10.1.51:8000/pedidosItems/'+id)
                    .then(function (response) {
                        console.log(response.data);
                        self.options = response.data;
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
        }
    });
</script>
