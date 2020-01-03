
<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Nosotros</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contacto</h4>
                    <ul class="list-unstyled">
                        <!--<li><a href="#" class="text-white">Follow on Twitter</a></li>-->
                        <!--<li><a href="#" class="text-white">Like on Facebook</a></li>-->
                        <li><a href="#" class="text-white">Mail</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!--    <style>


        .hogar-link.active img{ 
            content:url("img/hogar-70x70.svg") !important;
        }
        .moda-link.active img{ 
            content:url("img/moda-70x70-01.svg") !important;
        }

    </style>-->

    <?php 
    if($categoria_padre==1){
        $hogar = "img/hogar-70x70.svg";
        $moda = "img/moda-70x70-hover-04.svg";
    }else{
        $moda = "img/moda-70x70-01.svg";
        $hogar = "img/hogar-70x70-hover-03.svg";
    }
    ?>
    


    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div id="my-menu" class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
          <!--<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" focusable="false" aria-hidden="true"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
          <strong>Album</strong>-->
                <a class="hogar-link active" href="<?= yii\helpers\Url::to(['texsim/hogar']) ?>" style=" max-width:72px">
                    <img  src="<?= $hogar ?>" class="responsive boton-hogar" style=" max-width:72px" >
                </a>

                <a class="moda-link" href="<?= yii\helpers\Url::to(['texsim/moda']) ?>" style=" max-width:72px"> 
                    <img  src="<?= $moda ?>" class="responsive boton-moda" style=" max-width:72px" >
                </a>

            </a>
            <div class="iconos-barra">
                <div class="container-fluid">  

                    <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-1 mb-2 my-lg-0">
                        <!-- Search Button-->
                        <div data-toggle="search" class="nav-item navbar-icon-link">
                            <svg class="svg-icon">
                            <use xlink:href="#search-1"> </use>
                            </svg>
                        </div>
                        <!-- User Not Logged - link to login page-->
                        <div class="nav-item"><a href="customer-login.html" class="navbar-icon-link">
                                <svg class="svg-icon">
                                <use xlink:href="#male-user-1"> </use>
                                </svg><span class="text-sm ml-2 ml-lg-0 text-uppercase text-sm font-weight-normal d-none d-sm-inline d-lg-none"></span></a></div>
                        <!-- Cart Dropdown-->
                        <div class="nav-item dropdown"><a href="cart.html" class="navbar-icon-link d-lg-none"> 
                                <img class="svg-icon" src="img/menu-listado.svg" alt="listado"> <span class="text-sm ml-2 ml-lg-0 text-uppercase text-sm font-weight-normal d-none d-sm-inline d-lg-none"></span></a>
                            <div class="d-none d-lg-block"><a id="cartdetails" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="cart.html" class="navbar-icon-link dropdown-toggle">
                                    <img class="svg-icon" src="img/menu-listado.svg" alt="listado">
                                    <div class="navbar-icon-link-badge">3                         </div></a>
                                <div aria-labelledby="cartdetails" class="dropdown-menu dropdown-menu-right p-4">
                                    <div class="navbar-cart-product-wrapper">
                                        <!-- cart item-->
                                        <div class="navbar-cart-product"> 
                                            <div class="d-flex align-items-center"><a ><img  src="images/6951-microfibra240-liberty.jpg" alt="..." class="img-fluid navbar-cart-product-image"></a>
                                                <div class="w-100"><a href="#" class="close text-sm mr-2"><i class="fa fa-times">                                                   </i></a>
                                                  <div class="pl-3"> <a  class="navbar-cart-product-link">Microfibra240</a><small class="d-block text-muted">Cantidad: 1 </small><!--<strong class="d-block text-sm">$650.00 </strong>--></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- cart item-->
                                        <div class="navbar-cart-product"> 
                                            <div class="d-flex align-items-center"><a ><img  src="images/6951-microfibra240-liberty.jpg" alt="..." class="img-fluid navbar-cart-product-image"></a>
                                                <div class="w-100"><a href="#" class="close text-sm mr-2"><i class="fa fa-times">                                                   </i></a>
                                                  <div class="pl-3"> <a  class="navbar-cart-product-link">Microfibra240</a><small class="d-block text-muted">Cantidad: 1 </small><!--<strong class="d-block text-sm">$650.00 </strong>--></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- cart item-->
                                        <div class="navbar-cart-product"> 
                                            <div class="d-flex align-items-center"><a ><img  src="images/6951-microfibra240-liberty.jpg" alt="..." class="img-fluid navbar-cart-product-image"></a>
                                                <div class="w-100"><a href="#" class="close text-sm mr-2"><i class="fa fa-times">                                                   </i></a>
                                                  <div class="pl-3"> <a  class="navbar-cart-product-link">Microfibra240</a><small class="d-block text-muted">Cantidad: 1 </small><!--<strong class="d-block text-sm">$650.00 </strong>--></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- total price-->
                                    <!--<div class="navbar-cart-total"><span class="text-uppercase text-muted">Total</span><strong class="text-uppercase">$1950.00</strong></div>-->
                                    <!-- buttons-->
                                    <div class="d-flex justify-content-between"><a  class="btn btn-link text-dark mr-3">Listado<i class="fa-arrow-right fa"></i></a><a href="cart.html" class="btn btn-outline-dark">Consultar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </div>
</header>


  <!--<section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Album example</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>-->
<?php 
$categoria_padre==1?$color='color-hogar':$color='color-moda';
?>

    <section class=" barra-logo <?=$color?>"  >


        <div class="container">

            <a href="index.html"><div class=" col-12 logo"></div> </a>
        </div>
    </section>


    <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

