

<div class="chart-articulo">
    <div v-if="!articulo">
        <img src="img/loading.gif">
    </div>
    <!--    <router-link to="/">-->
    <!--        <button class="btn btn-success">Volver a Stock</button>-->
    <!--    </router-link>-->
    <div v-else="articulo">
        <div>
            <h3 >{{ articulo.articulo }} {{ articulo.variante.variante }} </h3>
            <h5 >{{ articulo.nom }} {{ articulo.variante.nom }}</h5>
        </div>
        <canvas id="myChart" ref="myChart" ></canvas>
        <div v-if="depositos" class="depositos">
            <div class="fila"></div>

            <div class="fila">
                <div class="columna">
                    <h5>Total Depositos:</h5>
                </div>
                <div class="columna">
                    <h5>piezas: {{articulo.variante.piezas}}</h5>
                </div>
                <div class="columna text-right">
                    <h5>{{articulo.variante.mts0}} MTS </h5>
                </div>

            </div>

            <template v-for="dep,i in depositos">
                <div class="fila">
                    <div class="columna">
                        <h5>Deposito {{dep.nro}}:</h5>
                    </div>
                    <div class="columna">
                        <h5>piezas: {{dep.piezas}}</h5>
                    </div>
                    <div class="columna text-right">
                        <h5>{{dep.mts}} MTS </h5>
                    </div>
                </div>
            </template>




        </div>
    </div>

</div>
