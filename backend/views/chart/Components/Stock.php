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
