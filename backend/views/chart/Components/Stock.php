<script>
    // efine a new component called button-counter
    const stock = Vue.component('stock', {
        data: function () {
            return {

                todosArticulos:[],
                cargas:[],
                variantes:[],
                row:null,
                collapse: false,
                articulo:{},
                existencia: [],
                loading: true,
                // pagmax:10,
                niddle:'',
                articulos: [],
                page: 1,
                pageCount: null,
                pagination:{},
                grafico: false,
                datos:[],
                fechas:[],
                cantidades:[],
            }
        },
        mounted() {
            this.getStock(1);
            // this.loading = false;
        },
        methods:{
            getPhoto(){
                var self = this;
                self.loading = true;
                axios.get('/admin/articulo/get-photo?codigo='+articulo.articulo+'&variante='+articulo.variante.variante)
                    .then(function (response) {
                        // self.loading= false;
                        // handle success
                        // console.log(response.data);
                        self.grafico = response.data;
                        // self.drawChart();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            filterArticulo(search){
                // console.log(search);
                var articulos = [];
                for(var i=0; i < this.todosArticulos.length ; i++){
                    if(!search || this.todosArticulos[i].articulo.toLowerCase().indexOf(search.toLowerCase()) != -1  || this.todosArticulos[i].nom.toLowerCase().indexOf(search.toLowerCase()) != -1 ){
                        articulos.push(this.todosArticulos[i]);
                    }
                }
                this.articulos = articulos;
            },
            getEstadisticaVariante: function(variante){
                var self = this;
                axios.get('/admin/chart/get-estadisticas-variante?articulo='+self.articulo.articulo+'&variante='+variante.variante)
                    .then(function (response) {
                        variante.imagen = response.data.imagen;
                        self.articulo.variante=variante;
                        // console.log(response.data);
                        self.fechas = response.data.fechas;
                        self.cantidades = response.data.cantidades;
                        // self.articulo = self.cargas.articulo;
                        // self.existencia = self.cargas.last;
                        self.grafico = true;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getEstadisticaArticulo: function(articulo){
                var self = this;
                self.articulo = articulo;
                axios.get('/admin/chart/get-estadisticas-articulo?articulo='+self.articulo.articulo)
                    .then(function (response) {
                        self.fechas = response.data.fechas;
                        self.cantidades = response.data.cantidades;
                        self.grafico = true;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getVariantes: function(articulo,num){
                this.variantes = null;
                this.acordion(num);
                var self = this;
                self.articulo = {};
                // self.loading = true;
                axios.get('/admin/chart/get-variantes/?articulo='+articulo.articulo)
                    .then(function (response) {
                        self.articulo = articulo;
                        // self.loading= false;
                        // handle success
                        self.variantes = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            acordion: function(num){
                if(this.row==num){
                    this.collapse = !this.collapse;
                }else {
                    this.row = num;
                    this.collapse = true;
                }
            },
            // verGrafico: function(articulo){
            //     this.articulo = articulo;
            //     this.grafico = true;
            // },
            getStock: function(page){
                var self = this;
                self.loading = true;
                axios.get('/admin/chart/get-articulos')
                    .then(function (response) {
                        self.loading= false;
                        // handle success
                        // console.log(response.data);
                        // self.datos = response.data;
                        self.articulos = response.data;
                        self.todosArticulos = response.data;
                        // self.pagination = response.data.pagination;
                        // self.page = page<self.pageCount?page:1;
                        // self.pageCount = response.data.pageCount;
                        // self.ordenarPorVariacion();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getVariacion: function(articulo){
                var largo = articulo['fechas'].length;
                var ultimo = articulo['fechas'][(largo-1)];
                var anteultimo = articulo['fechas'][(largo-2)];
                var dif = ultimo.cantidadTotal - anteultimo.cantidadTotal;
                var porcentaje = dif / ultimo.cantidadTotal;
                return porcentaje * 100;
            },

            ordenarPorVariacion(){
                this.articulos.sort((a, b) => parseFloat(b.variacion_cantidad) - parseFloat(a.variacion_cantidad))
            }

        },
        template: `<?=$this->render('StockTemplate')?>`
    })
</script>
<style>

    body{
        background-color: #020000;
        color: white;
    }

    .fila{
        border-bottom: white 1px solid;
        display: flex;
        align-items: center;
    }

    .columna{
        /*flex: 1;*/
        margin: 0.5em;
        font-size: 0.9em;

    }
    .mb-1{
        margin-bottom: 1em;
    }

    .variaciones button{
        justify-content: right;
        width: 70px;
        padding: 0.5em;
    }

    .stock-rows{
        background-color: #1d2124;
    }

    .unidades{
        width: 10%;
    }
    .cantidades{
        width: 20%;
    }
    .cantidades-articulos{
        width: 25%;
    }

    .valores{
        text-align: right;
        /*width: 20%;*/
    }
    .articulos-cod{
        font-size: 0.9em;
        width: 25%;
    }
    .articulos-nom{
        font-size: 0.9em;
        width: 40%;
    }

    .articulos{
        font-size: 0.9em;
        width: 50%;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* number of lines to show */
        -webkit-box-orient: vertical;
    }
    .variaciones{
        width: 20%;
        text-align: right;
    }

    .active{
        background-color: #2b6699 !important;
        color: white !important;
    }

    .loading{
        display: flex;
        justify-content: center;
        /*z-index: 1000;*/
    }
    .stock-rows a{
        color: white !important;
        text-decoration: none;
    }
    .pagination a{
        color: ;
    }

    .depositos .fila{
        justify-content: space-between;
    }
    .chart-articulo, .stock-template{
        max-width: 500px;
        margin: 0 auto;
    }


    .chart-articulo canvas{
        width: 100%;

    }

    .d-flex{
        display: flex;
        justify-content: center;
    }


    /*modal style*/


    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 90%;
        margin: 0px auto;
        padding: 30px 0 ;
        background-color: #020000;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-footer{
        margin-top: 2em;
    }

    .modal-body {
        /*margin: 10px 0;*/
        padding: 4px;
        max-height: calc(100vh - 110px);
        overflow-y: auto;
    }

    .modal-default-button {
        float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    .hidden{
        display: none !important;
    }

    .depositos .columna{
        width: 33%;
    }

</style>
