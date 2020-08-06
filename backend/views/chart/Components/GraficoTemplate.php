

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
                <h5>Total Depositos:</h5><div class="d-flex"><h5>{{articulo.variante.piezas}}</h5></h5><h5>{{articulo.variante.mts0}} </h5> </div>
            </div>
            <div class="fila">
                <h5>Deposito 1:</h5><div class="d-flex"><h5>{{depositos.nro1.piezas}}</h5><h5>{{depositos.nro1.mts}} </h5></div>
            </div>
            <div class="fila">
                <h5>Deposito 2:</h5><h5>{{depositos.nro2.mts}}  </h5>
            </div>
            <div class="fila">
                <h5>Deposito 3:</h5><h5>{{depositos.nro3.mts}}  </h5>
            </div>
            <div class="fila">
                <h5>Deposito 4:</h5><h5>{{depositos.nro4.mts}} </h5>
            </div>
            <div class="fila">
                <h5>Deposito 5:</h5><h5>{{depositos.nro5.mts}} </h5>
            </div>




        </div>
    </div>

</div>
