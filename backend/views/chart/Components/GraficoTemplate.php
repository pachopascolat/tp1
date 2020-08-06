

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
                <h5>Total Depositos:</h5><h5><span>{{articulo.variante.piezas}}pz</span>  {{articulo.variante.mts0}} MTS </h5>
            </div>

            <template v-for="dep,i in depositos">
                <div class="fila">
                    <h5>Deposito {{dep.nro}}:</h5><h5><span>{{dep.piezas}}pz</span>  {{dep.mts}} MTS </h5>
                </div>
            </template>
<!--            <div class="fila">-->
<!--                <h5>Deposito 2:</h5><h5><span>{{depositos.nro2.piezas}}pz</span>  {{depositos.nro2.mts}} MTS  </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 3:</h5><h5><span>{{depositos.nro3.piezas}}pz</span> {{depositos.nro3.mts}} MTS  </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 4:</h5><h5><span>{{depositos.nro4.piezas}}pz</span> {{depositos.nro4.mts}} MTS </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 5:</h5><h5><span>{{depositos.nro5.piezas}}pz</span> {{depositos.nro5.mts}} MTS</h5>-->
<!--            </div>-->




        </div>
    </div>

</div>
