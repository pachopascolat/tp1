<?php

use frontend\assets\AppAsset;

//AppAsset::register($this);
$catArray = ['Hogar', 'Moda'];
?>



<?= $this->render('/layouts/menu'); ?>

<?php echo $this->render('_carousel'); ?>

<style>

    /*******************************
* ACCORDION WITH TOGGLE ICONS
* Does not work properly if "in" is added after "collapse".
*******************************/



    .more-less-link{
        color: white;
        text-decoration: none ;
    }


    .more-less-link:hover{
        color: whitesmoke;
        text-decoration: none !important;
    }

    /* ----- v CAN BE DELETED v ----- */

</style>



<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-left">
            <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
            <li class="breadcrumb-item active">Buscador</li>
        </ol> 
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Resultados</h1>
            <!--<div class="row">   
              <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
            </div>-->
        </div>       
    </div>

</section>

<div class="text-center">
    <h5 class="<?= count($telas)>0?'d-none':''?>"> No se encontraron resultados </h5>
</div>

<div class="album py-5 <?= !count($telas)>0?'d-none':''?> ">
    <div class="container " >
        <!--<div class="lista-container panel-group" role="tablist" aria-multiselectable="true" >-->
            <?php
            $foo = 0;
//            foreach ($categorias as $index => $cat):
                ?>
<!--                <div role="tab" class="btn-title btn-dark panel-heading  ">
                    <a class="more-less-link"  data-toggle="collapse" href="#collapse<?php // echo $cat->id_categoria ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php // echo $cat->id_categoria ?>">
                        <h6 class="">
                            <?php // echo $cat->nombre_categoria ?>
                            <?php
//                            if ($cat->telas != null && count($cat->telas) > $foo):
                                ?>
                                                                                        <a role="button" class="more-less-link"  data-toggle="collapse" href="#collapse<?php // echo $cat->id_categoria ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php // echo $cat->id_categoria ?>">
                                <div class="float-right">                          
                                    <?php // echo"<small>ver telas</small>"; ?>
                                    <i class="fas fa-plus more-less"></i>
                                    <i class="fa fa-minus more-less " aria-hidden="true"></i>

                                    </a>    
                                </div>
                                <?php
//                            endif;
                            ?>

                        </h6>
                    </a>
                </div>
                <div  id="collapse<?php //  $cat->id_categoria ?>" class="collapse show" >-->
                    <?php
//                        if ($cat->telas == null) {
//                            echo "<div class='row'></div>";
//                        }
//                    $telas = common\models\Tela::find()->where(['categoria_id' => $cat->id_categoria])->orderBy('orden_tela')->all();
                    $odd = true;
                    foreach ($telas as $key => $tela):
//                        if ($catTela->tela && !$catTela->tela->ocultar && !$catTela->tela->estaVacia()):
//                            $tela = $catTela->tela;
                            ?>
                            <div  class="row" >
                                <div class="col-12 col-md-12 col-sm-12">
                                    <div>
                                        <a  class="col-12  btn <?= $odd ? "btn-light" : "btn-gray-200" ?> text-dark text-left letter-spacing" href="<?= yii\helpers\Url::to(['texsim/categorias', 'id' => $tela->id_tela, 'nombre_tela' => $tela->nombre_tela]) ?>">
                                            <h6><?= $tela->nombre_tela ?> <small><?= $tela->descripcion_tela ?></small></h6>
                                        </a>
                                    </div>
                                </div> 
                            </div>

                            <?php
                            $odd = !$odd;
//                        endif;
                    endforeach;
                    ?>
<!--                </div>
                <div style="height: 2rem">
                </div>-->
                <?php // endforeach; ?>
        <!--</div>-->

    </div>

</div>



<?php
echo $this->render('/layouts/footer');
?>

