

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
<!--        <div v-if="articulo" class="depositos">-->
<!--            <div class="fila"></div>-->
<!--            <div class="fila">-->
<!--                <h5>Total Depositos:</h5><h5>{{existencia[5].cantidad}} {{existencia[5].u_medida}} </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 1:</h5><h5>{{existencia[0].cantidad}} {{existencia[0].u_medida}} </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 2:</h5><h5>{{existencia[1].cantidad}} {{existencia[1].u_medida}} </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 3:</h5><h5>{{existencia[2].cantidad}} {{existencia[2].u_medida}} </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 4:</h5><h5>{{existencia[3].cantidad}} {{existencia[3].u_medida}} </h5>-->
<!--            </div>-->
<!--            <div class="fila">-->
<!--                <h5>Deposito 5:</h5><h5>{{existencia[4].cantidad}} {{existencia[4].u_medida}} </h5>-->
<!--            </div>-->
<!---->
<!---->
<!---->
<!---->
<!--        </div>-->
    </div>

</div>
