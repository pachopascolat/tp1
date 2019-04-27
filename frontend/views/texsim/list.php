<?php

use frontend\assets\AppAsset;

//AppAsset::register($this);
$catArray = ['Hogar', 'Moda'];
?>



<?= $this->render('/layouts/menu', ['categoria_padre' => $categoria_padre]); ?>

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
            <li class="breadcrumb-item active"><?= $catArray[$categoria_padre - 1] ?></li>
        </ol> 
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Todas las Telas</h1>
            <!--<div class="row">   
              <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
            </div>-->
        </div>       
    </div>

</section>

<div class="album py-5 ">
    <div class="container " >
        <div class="lista-container panel-group" role="tablist" aria-multiselectable="true" >
            <?php
            $foo = 0;
            foreach ($categorias as $index => $cat):
                ?>
                <div role="tab" class="btn-title btn-dark panel-heading  ">
                    <a class="more-less-link"  data-toggle="collapse" href="#collapse<?= $cat->id_categoria ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= $cat->id_categoria ?>">
                        <h6 class="">
                            <?= $cat->nombre_categoria ?>
                            <?php
                            if ($cat->telas != null && count($cat->telas) > $foo):
                                ?>
                                                                <!--<a role="button" class="more-less-link"  data-toggle="collapse" href="#collapse<?= $cat->id_categoria ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= $cat->id_categoria ?>">-->
                                <div class="float-right">                          
                                    <?php if ($index == 0) echo"<small>ver telas</small>"; ?>
                                    <i class="fas fa-plus more-less"></i>
                                    <!--</a>-->    
                                </div>
                                <?php
                            endif;
                            ?>

                        </h6>
                    </a>
                </div>
                <div  id="collapse<?= $cat->id_categoria ?>" class="collapse" >
                    <?php
//                        if ($cat->telas == null) {
//                            echo "<div class='row'></div>";
//                        }
                    $telas = common\models\Tela::find()->where(['categoria_id' => $cat->id_categoria])->orderBy('orden_tela')->all();

                    foreach ($telas as $key => $tela):
                        $key % 2 == 0 ? $color = "btn-light" : $color = "btn-gray-200";
                        ?>
                        <div  class="row" >
                            <div class="col-12 col-md-12 col-sm-12">
                                <div>
                                    <a  class="col-12  btn <?= $color ?> text-dark text-left letter-spacing" href="<?= yii\helpers\Url::to(['texsim/categorias', 'id' => $tela->id_tela, 'nombre_tela' => $tela->nombre_tela]) ?>">
                                        <h6><?= $tela->nombre_tela ?> <small><?= $tela->descripcion_tela ?></small></h6>
                                    </a>
                                </div>
                            </div> 
                        </div>

                    <?php endforeach; ?>
                </div>
                <div style="height: 2rem">
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>



<?php echo $this->render('/layouts/footer'); ?>


<script>

    /*******************************
     * ACCORDION WITH TOGGLE ICONS
     *******************************/
    function toggleIcon(e) {
        var heading = $(e.target).prev('.panel-heading');
        var icon = heading.find('.more-less');

        icon.toggleClass('fa-plus fa-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>