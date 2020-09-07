<div class="stock-template">
    <div class="p-1 d-flex">
<!--    <a name="" id="" class="btn btn-primary btn-sm p-1" href="--><?//=\yii\helpers\Url::to(['/estado-pedido/crear-pedido'])?><!--" role="button">Nuevo</a>-->
    <a name="" id="" class="btn btn-danger btn-sm p-1" href="<?=\yii\helpers\Url::to(['/estado-pedido/index'])?>" role="button">Pedidos</a>
    </div>
        <div class="input-group">
        <input  v-model="niddle" class="form-control mb-1" placeholder="ingrese articulo">
        <span class="input-group-btn">
            <button @click="filterArticulo(niddle)" class="btn btn-success" >
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
    <div v-if="loading" class="loading">
        <img  src="<?=Yii::getAlias('@web/img/loading.gif')?>">
    </div>
    <div v-else class="">
        <div v-for="(article,j) in articulos">
            <div  class="fila">
                <div @click="getVariantes(article,j)" class="columna articulos-cod">
                    <span>{{article.articulo}}</span>
                </div>
                <div @click="getVariantes(article,j)" class="columna articulos-nom">
                    <span>{{article.nom}}</span>
                </div>
                <div @click="getVariantes(article,j)" class="columna unidades valores">
                    {{article.piezas}}
                </div>
                <div @click="getVariantes(article,j)" class="columna cantidades-articulos valores">
                    {{parseFloat(article.mts).toFixed(0)}} {{article.u_medida}}
                </div>
                <div @click="getEstadisticaArticulo(article)" class="variaciones columna">
                    <div v-if="parseFloat(article.delta)>0"> <button class="btn btn-success btn-sm text-nowrap"> + {{parseFloat(article.delta).toFixed(2)}} %</button></div>
                    <div v-if="parseFloat(article.delta)<0"> <button class="btn btn-danger btn-sm text-nowrap"> {{parseFloat(article.delta).toFixed(2)}} %</button> </div>
                    <div v-if="parseFloat(article.delta)==0"><button class="btn btn-light btn-sm text-nowrap"> - </button> </div>
                </div>
            </div>
            <div v-if="collapse&&row==j" class="stock-rows">
                <div   v-for="(art,i) in variantes"  v-bind:key="i" >
                    <!--            <router-link :to="{name:'grafico',params:{codColor:String(art.last.cod_color),codArticulo:art.last.cod_articulo}}" >-->
                    <div v-on:click="getEstadisticaVariante(art)" class="fila">
                        <div class="columna ">
                            <span class="mr-2">{{art.variante}}</span>
                        </div>
                        <div class="columna ">
                             <span>{{art.nom}}</span>
                        </div>
                        <div class="columna valores unidades">
                            <!--                    <div class="">Unidades Total</div>-->
                            <div>{{art.piezas}}</div>
                        </div>
                        <div class="columna valores cantidades">
                            <!--                    <div>Cantidad Total</div>-->
                            <div>
                                {{parseFloat(art.mts).toFixed(0)}} {{art.u_medida}}
                            </div>
                        </div>
                        <div class="variaciones columna">
                            <div v-if="parseFloat(art.delta)>0"> <button class="btn btn-success btn-sm text-nowrap"> + {{parseFloat(art.delta).toFixed(2)}} %</button></div>
                            <div v-if="parseFloat(art.delta)<0"> <button class="btn btn-danger btn-sm text-nowrap"> {{parseFloat(art.delta).toFixed(2)}} %</button> </div>
                            <div v-if="parseFloat(art.delta)==0"><button class="btn btn-light btn-sm text-nowrap"> - </button> </div>
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


