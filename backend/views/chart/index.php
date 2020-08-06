<!--<script src="https://cdn.jsdelivr.net/npm/vue"></script>-->

<?php


//$this->registerJsFile("https://use.fontawesome.com/a35639f299.js",['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("https://cdn.jsdelivr.net/npm/vue/dist/vue.js",['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/vue-router/dist/vue-router.js",['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("https://cdn.jsdelivr.net/npm/chart.js@2.8.0",['position'=>\yii\web\View::POS_BEGIN]);
//$this->registerJsFile("https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js",['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile("https://unpkg.com/axios/dist/axios.min.js",['position'=>\yii\web\View::POS_HEAD]);
?>
<?php

// display pagination

?>

<div id="app">
    <!--    <router-link to="/stock">Stock</router-link>-->
    <!--    <router-link to="/chart">Chart</router-link>-->


    <router-view></router-view>
</div>

<?= $this->render('Components/Stock'); ?>
<?= $this->render('Components/Grafico'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>



    const routes = [
        // { path: '/stock', component: stock },
        { path: '/', component: stock },
        { path: '/grafico/:codArticulo/:codColor', name:'grafico' ,component: grafico, props:true }
    ]

    const router = new VueRouter({
        routes // short for `routes: routes`
    })

    const app = new Vue({
        router
    }).$mount('#app')


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
        /*font-size: 0.8em;*/
        s
    }
    .mb-1{
        margin-bottom: 1em;
    }

    .variaciones button{
        justify-content: right;
        width: 50px;
        padding: 0.5em;
        font-size: 1rem;
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
        font-size: 1.2rem;
        text-align: right;
        /*width: 20%;*/
    }
    .articulos-solos{
        width: 65%;
        font-size: 1.2rem;
    }

    .articulos{
        font-size: 1.2rem;
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


</style>
