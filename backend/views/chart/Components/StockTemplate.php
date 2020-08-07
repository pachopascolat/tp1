<div class="stock-template">
    <input @keypress="filterArticulo(niddle)" v-model="niddle" class="form-control mb-1" placeholder="ingrese articulo">
    <div v-if="loading" class="loading">
        <img  src="<?=Yii::getAlias('@web/img/loading.gif')?>">
    </div>
    <div v-else class="">
        <div v-for="(article,j) in articulos">
            <div v-on:click="getVariantes(article,j)" class="fila">
                <div class="columna articulos-solos">
                    {{article.articulo}} {{article.nom}}
                </div>
                <div class="columna unidades valores">
                    {{article.piezas}}
                </div>
                <div class="columna cantidades-articulos valores">
                    {{parseFloat(article.mts0).toFixed(2)}} {{article.u_medida}}
                </div>
            </div>
            <div v-if="collapse&&row==j" class="stock-rows">
                <div   v-for="(art,i) in variantes"  v-bind:key="i" >
                    <!--            <router-link :to="{name:'grafico',params:{codColor:String(art.last.cod_color),codArticulo:art.last.cod_articulo}}" >-->
                    <div v-on:click="getEstadistica(art)" class="fila">
                        <div class="columna articulos">
                            {{art.variante}} {{art.nom}}
                        </div>
                        <div class="columna hidden">
                            <div>Variación</div>
                            <div>{{art.delta}}</div>
                        </div>
                        <div class="columna valores unidades">
                            <!--                    <div class="">Unidades Total</div>-->
                            <div>{{art.piezas}}</div>
                            <div class="variaciones hidden">
                                <div v-if="art.delta>0"> <button class="btn btn-success btn-sm"> + {{art.delta}} %</button></div>
                                <div v-if="art.delta<0"> <button class="btn btn-danger btn-sm"> {{art.delta}} %</button> </div>
                                <div v-if="art.delta==0"><button class="btn btn-default btn-sm"> - </button> </div>
                            </div>
                        </div>
                        <div class="columna valores cantidades">
                            <!--                    <div>Cantidad Total</div>-->
                            <div>
                                {{art.mts0}} {{art.u_medida}}
                            </div>
                        </div>
                        <div class="variaciones columna">
                            <div v-if="parseFloat(art.delta)>0"> <button class="btn btn-success btn-sm"> + {{parseFloat(art.delta).toFixed(2)}} %</button></div>
                            <div v-if="parseFloat(art.delta)<0"> <button class="btn btn-danger btn-sm"> {{parseFloat(art.delta).toFixed(2)}} %</button> </div>
                            <div v-if="parseFloat(art.delta)==0"><button class="btn btn-default btn-sm"> - </button> </div>
                        </div>
                    </div>
                    <!--            </router-link>-->
                </div>
            </div>
        </div>
    </div>
    <!--    <nav aria-label="...">-->
    <!--        <ul class="pagination">-->
    <!--            <li class="page-item" v-bind:class="page==1?'disabled':''">-->
    <!--                <a v-on:click="getStock(page-1)" class="page-link" href="#" tabindex="-1">Previous</a>-->
    <!--            </li>-->
    <!--            <li class="page-item">-->
    <!--                <a v-on:click="getStock(page+1)" class="page-link" v-bind:class="page==1?'disabled':''">Next</a>-->
    <!--            </li>-->
    <!--        </ul>-->
    <!--    </nav>-->
    <div v-if="grafico" @close="grafico = false">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <div class="modal-body">
                            <slot name="body">
                                <grafico
                                        v-bind:articulo="articulo"
                                        v-bind:fechas="fechas"
                                        v-bind:cantidades="cantidades"
                                ></grafico>
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="btn btn-sm btn-success" @click="grafico=false">
                                    Cerrar
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>

</div>


