<script>



    // Define a new component called button-counter
    const grafico = Vue.component('grafico', {
        props:{
            cargas: Object,
            existencia: Array,
            articulo: Object,
            codArticulo: String,
            codColor: String,
            niddle: String,
            cantidades: Array,
            fechas: Array
        },
        data: function () {
            return {
                depositos:{
                    nro1:{piezas:0,mts:0},
                    nro2:{piezas:0,mts:0},
                    nro3:{piezas:0,mts:0},
                    nro4:{piezas:0,mts:0},
                    nro5:{piezas:0,mts:0},

                },
                loading: true,
                // articulo:null,
                // cantidades: []
                // pag,
            }
        },
        mounted(){
            this.drawChart();
            this.getDepositos();
            // this.getArticulo();

        },
        methods:{
            getDepositos(){
                for(var i = 1; i < 6 ; i++){
                    this.getPorDeposito(i);
                }
            },
            getPorDeposito(deposito){
                var self = this;
                // self.loading = true;
                axios.get('/admin/chart/get-deposito?deposito='+deposito+'&articulo='+self.articulo.articulo+'&variante='+self.articulo.variante.variante)
                    .then(function (response) {
                        console.log(response.data);
                        if(response.data) {
                            self.depositos['nro' + deposito].mts = response.data.mts0;
                            self.depositos['nro' + deposito].piezas = response.data.piezas;
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
            getCantidades: function(){
                var cantidades = [];
                for(var i in this.cargas.fechas){
                    cantidades.push(this.cargas.fechas[i][5].cantidad)
                }
                cantidades.push(0);
                this.cantidades = cantidades;
                return cantidades;

            },
            getFechas: function(){
                var fechas = [];
                var timestamp = Object.keys(this.cargas.fechas);
                console.log(timestamp);
                for(var i = 0; i < timestamp.length; i++){
                    const milliseconds = timestamp[i] * 1000;
                    const dateObject = new Date(milliseconds);
                    fechas.push(dateObject.toLocaleDateString("es-AR"));
                }
                return fechas;
            },
            drawChart: function(){
                var cantidades = this.cantidades;
                var fechas = this.fechas;
                // console.log(this.$refs['mychart']);
                var ctx = this.$refs.myChart.getContext('2d');
                var gradientFill = ctx.createLinearGradient(0, 0, 0, 160);
                gradientFill.addColorStop(0, "rgba(125, 235, 133, 0.6)");
                gradientFill.addColorStop(1, "rgba(125, 235, 133, 0.1)");
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',

                    // The data for our dataset
                    data: {
                        // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        labels: fechas,
                        datasets: [{
                            label: 'Cantidad Total',
                            backgroundColor: gradientFill,
                            borderColor: '#54d477',
                            data: cantidades,
                        }]
                    },

                    // Configuration options go here
                    options: {}
                });

            },
            getArticulo: function(){
                var self = this;
                self.loading = true;
                axios.get('/apiv1/stock/ver-chart?codColor='+self.codColor+'&codArticulo='+self.codArticulo,)
                    .then(function (response) {
                        self.loading= false;
                        // handle success
                        // console.log(response.data);
                        self.articulo = response.data;
                        self.drawChart();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            },
        },
        template: `<?=$this->render('GraficoTemplate')?>`
    })


</script>
