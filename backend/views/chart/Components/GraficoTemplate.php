

<div class="chart-articulo">
    <div v-if="!articulo">
        <img src="img/loading.gif">
    </div>
    <!--    <router-link to="/">-->
    <!--        <button class="btn btn-success">Volver a Stock</button>-->
    <!--    </router-link>-->
    <div v-else="articulo">
        <div>
            <h3 >{{ articulo.articulo }} {{articulo.nom  }} </h3>
            <h5 v-if="articulo.variante" >{{ articulo.variante.variante }} {{ articulo.variante.nom }}</h5>
        </div>
        <canvas id="myChart" ref="myChart" ></canvas>
        <div v-if="depositos" class="depositos">
            <div class="fila"></div>

            <div class="fila">
                <div class="columna">
                    <h5>Total Depositos:</h5>
                </div>
                <div class="columna">
                    <h5 v-if="articulo.variante">piezas: {{articulo.variante.piezas}}</h5>
                    <h5 v-else>piezas: {{articulo.piezas}}</h5>
                </div>
                <div class="columna text-right">
                    <h5 v-if="articulo.variante">{{articulo.variante.mts}} MTS </h5>
                    <h5 v-else>{{articulo.mts}} MTS </h5>
                </div>

            </div>

            <template v-for="dep,i in depositos">
                <div class="fila">
                    <div class="columna">
                        <h5>Deposito {{dep.depo_nom}}:</h5>
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
