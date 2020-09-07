<!--<script src="https://cdn.jsdelivr.net/npm/vue"></script>-->

<?php
\backend\assets\BackendAsset::register($this);


$this->registerJsFile("https://cdn.jsdelivr.net/npm/chart.js@2.8.0",['position'=>\yii\web\View::POS_BEGIN]);


?>
<?php

// display pagination

?>

<div id="app" class="pt-3">
    <!--    <router-link to="/stock">Stock</router-link>-->
    <!--    <router-link to="/chart">Chart</router-link>-->

    <stock></stock>

<!--    <router-view></router-view>-->
</div>

<?= $this->render('Components/Stock'); ?>
<?= $this->render('Components/Grafico'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>



    // const routes = [
    //     // { path: '/stock', component: stock },
    //     { path: '/', component: stock },
    //     { path: '/grafico/:codArticulo/:codColor', name:'grafico' ,component: grafico, props:true }
    // ]
    //
    // const router = new VueRouter({
    //     routes // short for `routes: routes`
    // })

    const app = new Vue({
        // router
    }).$mount('#app')


</script>



