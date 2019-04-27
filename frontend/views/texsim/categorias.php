<?php
$menus = [null, "hogar", "moda"];
//$disenios = $model->getBehavior('galleryBehavior')->getImages();
?>

<!doctype html>
<html>
        <?= $this->render('/layouts/head'); ?>


    <body>


        <?= $this->render('/layouts/menu', ['categoria_padre' => $categoria_padre]); ?>   

        <?php
        $categoria_padre == 1 ? $color = '#F06386' : $color = '#CFC92A';
        ?>

        <style>
            .swiper-pagination-progressbar .swiper-pagination-progressbar-fill{
                background: <?= $color ?>;
            }
        </style>


        <section class="hero">
            <div class="container">
                <!-- Breadcrumbs -->
                <ol class="breadcrumb justify-content-left">
                    <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to(['index']) ?>">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="<?= yii\helpers\Url::to([$menus[$model->categoria->categoria_padre]]) ?>"><?= $menus[$model->categoria->categoria_padre] ?></a></li>
                    <li class="breadcrumb-item active"><?= $model->getNombreCompleto() ?>        </li>
                </ol>
                <!-- Hero Content-->
                <div class="hero-content pb-5 text-center">
                    <h1 class="hero-heading"><?= $model->getNombreCompleto() ?></h1>
                    <!--<div class="row">   
                      <div class="col-xl-8 offset-xl-2"><p class="lead text-muted">You have 3 items in your shopping cart</p></div>
                    </div>-->
                </div>
            </div>
        </section>

        <div class="album py-5 ">
            <div class="container">

                <div class="">
                    <?php
                    $gruposA = [];
                    $grupos = [];
                    foreach ($model->grupos as $gindex => $grup) {
                        $imagenes = $grup->getBehavior('galleryBehavior')->getImages();
                        $filas[] = $imagenes;
                        if ($gindex != 0 && ($gindex + 1) % 3 == 0) {
                            $gruposA[] = $filas;
                            $filas = [];
                        }
                    }

                    foreach ($gruposA as $gindex => $grupo) {
                        foreach ($grupo as $findex => $fila) {
                            $col = $findex;
                            foreach ($fila as $diseño) {
                                $disenios[$col] = $diseño;
                                $col += 3;
                            }
                        }
                        ksort($disenios);
                        $grupos[$gindex] = $disenios;
                        $disenios = [];
                    }
//                    foreach ($filas as $findex => $fila) {
//                        $col = $findex;
//                        foreach ($fila as $diseño) {
//                            $disenios[$col] = $diseño;
//                            $col += 3;
//                        }
//                    }
//                $totalDiseños = count($disenios);
//                if ($totalDiseños < 30) {
//                    $maxCol = 6;
//                    $filas = array_chunk($disenios, 6);
//                } else {
//                    $filas = array_chunk($disenios, ceil($totalDiseños / 5));
//                }

                    foreach ($grupos as $disenios):
                        ?>
                        <div class="">
                            <div class="swiper-container swiper1">
                                <div class="swiper-wrapper">
                                    <?php
//                                    $disenios = $grupo->getBehavior('galleryBehavior')->getImages();
//                                    $fila = -1;
////                                    $foo = 0;
//                                    $cantDis = count($disenios);
//                                    $resto = $cantDis % 3;
//                                    if ($resto == 2) {
//                                        $disenios[] = $disenios[$cantDis - 1];
//                                    }
//                                    if ($resto == 1) {
//                                        $disenios[] = $disenios[$cantDis - 1];
//                                        $disenios[] = $disenios[$cantDis];
//                                    }

                                    foreach ($disenios as $key => $dis):

                                        $jsonDisenios = json_encode($disenios);
//                                        $columnas = count($disenios) / 3;
//
//                                        if (($key) % 3 == 0) {
//                                            $fila ++;
//                                            $foo = $fila;
//                                        } elseif($key == 0) {
//                                            $foo = 0;
//                                            $fila++;
//                                        }else{
//                                            $foo = $foo + $columnas;
//                                        }
//                                        if ($foo < count($disenios)) {
//                                            $dis = $disenios[$foo];
//                                            
//                                        }
//                                        $x = 1;
                                        ?>   
                                        <div class="swiper-slide">
                                            <div class="product">
                                                <div class="product-image">
                                                    <img  src="<?= $dis->getUrl('preview') ?>" alt="product" class="img-fluid"/>
                                                    <div class="product-hover-overlay"><a  class="product-hover-overlay-link"></a>
                                                        <div class="product-hover-overlay-buttons">                                                       
                                                            <a href="#" class="btn btn-outline-light btn-product-left">
                                                                <i class="fa fa-check"></i>
                                                            </a>                  
                                                            <a data-disenios="<?= $jsonDisenios ?>" data-tela="<?= $model->getNombreCompleto() ?>" data-codigo="<?= $dis->name ?>" data-descripcion='<?= $model->descripcion_larga_tela ?>' data-image="<?= $dis->getUrl('original') ?>" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-light btn-product-right modal-btn">
                                                                <i class="fa fa-expand-arrows-alt"></i>
                                                            </a>
                                                        </div>
                                                        <div class="product-code text-light "><p><?= $dis->name ?></p></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                    <?php
                                    $faltan = 3 - (count($disenios) % 3);
                                    if ($faltan != 3) {
                                        for ($i = 0; $i < $faltan; $i++) {
                                            echo '<div class="swiper-slide"></div>';
                                        }
                                    }
                                    ?>

                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- If we need navigation buttons -->
                                <!--                    <div class="swiper-button-prev swiper-button-white"></div>
                                                    <div class="swiper-button-next swiper-button-white"></div>-->

                                <!-- If we need scrollbar -->
                                <!--<div class="swiper-scrollbar"></div>-->

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>




                <div class="shadow-swiper-container"></div> 
                <?php
                if ($model->discontinuos != null && count($model->discontinuos->getBehavior('galleryBehavior')->getImages()) > 0):
                    ?>
                    <div class="barra-clasificacion"> <p>Discontinuos</p></div>  
                    <div class="swiper-container swiper1">
                        <div class="swiper-wrapper">      
                            <?php foreach ($model->discontinuos->getBehavior('galleryBehavior')->getImages() as $discontinuo) : ?>
                                <div class="swiper-slide">
                                    <div class="product">
                                        <div class="product-image">
                                            <img  src="<?= $discontinuo->getUrl('preview') ?>" alt="product" class="img-fluid"/>
                                            <div class="product-hover-overlay"><a  class="product-hover-overlay-link"></a>
                                                <div class="product-hover-overlay-buttons">
                                                    <a href="#" class="btn btn-outline-light btn-product-left">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    <!--                                                    <a  class="btn btn-dark btn-buy">
                                                                                                            <i class="fa-search fa"></i>
                                                                                                            <span class="btn-buy-label ml-2">View</span>
                                                                                                        </a>-->
                                                    <a data-image="<?= $discontinuo->getUrl('original') ?>" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-light btn-product-right">
                                                        <i class="fa fa-expand-arrows-alt"></i>
                                                    </a>

                                                </div>
                                                <div class="product-code text-light "><p><?= $discontinuo->name ?></p></div>
                                            </div>
                                        </div>

                                    </div>
                                </div> 
                            <?php endforeach; ?>
                        </div> 
                    </div>

                    <div class="shadow-swiper-container"></div>  
                <?php endif; ?>
                <?php if ($model->lisos != null && count($model->lisos->getBehavior('galleryBehavior')->getImages()) > 0): ?>
                    <div class="productos-fijos position-sticky" >
                        <div class="barra-clasificacion"> <p>Lisos</p></div>  
                        <div class="swiper-container swiper2"  >
                            <div class="swiper-wrapper" >      

                                <?php foreach ($model->lisos->getBehavior('galleryBehavior')->getImages() as $lisos) : ?>

                                    <div class="swiper-slide">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="product-code text-light "><p><?= $lisos->name ?></p></div>
                                                <img src="<?= $lisos->getUrl('preview') ?>" alt="product" class="img-fluid"/>
                                                <div class="product-hover-overlay">
                                                    <a  class="product-hover-overlay-link"></a>
                                                    <div class="product-hover-overlay-buttons hover-fijos">
                                                        <a href="#" class="btn btn-outline-light btn-product-left">
                                                            <i class="fa fa-check"></i></a>
                                                        <!--                                                        <a  class="btn btn-dark btn-buy">
                                                                                                                    <i class="fa-search fa"></i>
                                                                                                                    <span class="btn-buy-label ml-2">View</span>
                                                                                                                </a>-->
                                                        <a data-image="<?= $lisos->getUrl('original') ?>" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-light btn-product-right">
                                                            <i class="fa fa-expand-arrows-alt"></i>
                                                        </a>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>




                            </div>
                        </div>  

                    </div>
                <?php endif; ?>




            </div>
        </div>

        <div id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade quickview">
            <div role="document" class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close modal-close">
                        <svg class="svg-icon w-100 h-100 svg-icon-light align-middle">
                        <use xlink:href="#close-1"> </use>
                        </svg>
                    </button>
                    <div class="modal-body"> 
                        <!--<div class="ribbon ribbon-primary">Nuevo</div>-->
                        <div class="row">
                            <div class="col-lg-6">
                                <!--<img id="modal-img" class="detail-full-item-modal" src="images/6951-microfibra240-liberty.jpg">-->
                                <!--<div data-slider-id="1" class="owl-carousel owl-theme owl-dots-modern detail-full">-->
                                <div id="modal-img" style="background: center center  url(images/6951-microfibra240-liberty.jpg) no-repeat; background-size: cover;" class="detail-full-item-modal">  
                                </div>
                                <!--<div style="background: center center  url(images/6951rep-microfibra240-liberty.jpg) no-repeat; background-size: cover;" class="detail-full-item-modal">-->  
                                <!--</div>-->
                                <!--</div>-->
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div>
                                    <h3 id="modal-disenio-codigo" class=" mt-2 mt-lg-1 font-alt">6951</h3>
                                    <h2 id="modal-tela-nombre" class="mb-2  mt-lg-1 text-tiles">Microfibra240</h2>

                                    <p id="modal-descripcion" class="mb-4 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                                    <form action="#">
                                        <div class="row">

                                            <div class="col-12 detail-option mb-3">
                                                <label class="detail-option-heading font-weight-bold">Cantidad </label>
                                                <input name="items" type="number" value="1" class="form-control detail-quantity">
                                            </div>
                                        </div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button type="submit" class="btn btn-dark btn-lg mb-1"> Agregar a la consulta <i class="fa fa-chevron-right"></i></button>
                                            </li>

                                        </ul>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->render('/layouts/footer'); ?>        
        <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('image'); // Extract info from data-* attributes
                var descripcion = button.data('descripcion');
                var tela = button.data('tela');
                var codigo = button.data('codigo');
                // 
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                //                var modal = $(this);
                //                $('#modal-img').attr('src', recipient);
                $('#modal-img').css("background", "center center  url(" + recipient + ") no-repeat");
                $('#modal-img').css("background-size", "cover");
                $('#modal-descripcion').text(descripcion);
                $('#modal-disenio-codigo').text(codigo);
                $('#modal-tela-nombre').text(tela);

                //                modal.find('.modal-title').text('New message to ' + recipient)
                //                modal.find('.modal-body input').val(recipient)
            })
            //            $(document).ready(function () {
            //                $(".modal-btn").click(function () {
            //                    $('#modal-img').attr('src',$(this).data('image'));
            //                    $('#exampleModal').modal('show');
            //                });
            //            });
        </script>
        <script>
            var swiper1 = new Swiper('.swiper1', {
//                loop:true,
                grabCursor: true,
                slidesPerView: 8,
                spaceBetween: 4,
                slidesPerColumn: 3,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'progressbar',
//                    clickable: true,

                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpointsInverse: true,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 4,
                        spaceBetween: 4,
                        slidesPerColumn: 3,

                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 6,
                        spaceBetween: 4,
                        slidesPerColumn: 3,

                    },
                    // when window width is >= 640px
                    520: {
                        slidesPerView: 4,
                        spaceBetween: 6,
                        slidesPerColumn: 3,

                    },

                    980: {
                        slidesPerView: 6,
                        spaceBetween: 8,
                        slidesPerColumn: 3,

                    }
                }
            });


            var swiper2 = new Swiper('.swiper2', {
                slidesPerView: 8,
                spaceBetween: 4,

                breakpointsInverse: true,
                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 4,
                        spaceBetween: 4
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 4,
                        spaceBetween: 4
                    },
                    // when window width is >= 640px
                    520: {
                        slidesPerView: 4,
                        spaceBetween: 6
                    },
                    980: {
                        slidesPerView: 6,
                        spaceBetween: 8
                    }
                }
            });

        </script>
    </body>
</html>
