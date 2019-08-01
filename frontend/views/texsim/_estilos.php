<?php
$categoria_padre == 1 ? $color = '#F06386' : $color = '#CFC92A';
?>

<style>
    .ribbon-agotado::before{
        border-top: 14px solid #EF453D;
    }

    .ribbon-agotado{
        background-color: #EF453D;
        font-size: 1.5em;
        z-index: 50;
    }
    .ribbon-oferta{
        background-color: #4D265B;
        font-size: 1.5em;
        }

    .ribbon-oferta::before{
        border-top: 14px solid #4D265B;
    }
    .carrito-link:hover .tooltiptext-link {
        /*visibility: visible;*/
    }

    .img-agotado{
        position: absolute;
        top:10%;
        right: 0;
        width: 70%;

    }


    @media (min-width:320px)  { 
         /*smartphones, iPhone, portrait 480x320 phones*/  

         .product-code-texsim{
             font-size: 0.7rem;
         }
         
        .lisos-fixed{
            bottom:-40px;
            /*position: sticky !important ;*/
            /*position: -webkit-sticky !important;*/           
        }
        .swiper-button-prev{
            width: 3em ;
            height: 3em ;
            background-size: 3em ;
            border: none ;

        }
        .swiper-button-next{
            width: 3em ;
            height: 3em ;
            background-size: 3em ;
            border: none ;

        }
        .zoom-texsim{
            font-size: 0.6em ;
        }
    }
    @media (min-width:481px)  {
         /*portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide.*/  

        .lisos-fixed{
            bottom:-50px;
            /*position: sticky !important ;*/
            /*-webkit-position: sticky !important;*/
        }
        .product-code-texsim{
             font-size: 0.8rem;
         }

        .swiper-button-prev{
            width: 4em ;
            height: 4em ;
            background-size: 4em ;
            /*border: none ;*/

        }
        .swiper-button-next{
            width: 4em ;
            height: 4em ;
            background-size: 4em ;
            border: none ;

        }
        .zoom-texsim{
            font-size: 0.9em ;
        }
    }
    @media (min-width:641px)  {
         /*portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones*/ 

         .product-code-texsim{
             font-size: 0.9rem;
         }
         
        .lisos-fixed{
            bottom:-60px;
            /*position: sticky !important ;*/
            /*-webkit-position: sticky !important;*/
        }
    }
    @media (min-width:961px)  {
         /*tablet, landscape iPad, lo-res laptops ands desktops*/  

         .product-code-texsim{
             font-size: 1rem;
         }
         
        .lisos-fixed{
            bottom:-70px;
            /*position: sticky !important ;*/
            /*position: sticky !important ;*/
            /*-webkit-position: sticky !important;*/
        }
    }
    @media (min-width:1025px) {
         /*big landscape tablets, laptops, and desktops*/  

        .lisos-fixed{
            position: fixed !important ;
            /*-webkit-position: sticky;*/
            bottom:-80px ;
            /*position: sticky !important;*/
            /*position: -webkit-sticky !important;*/           
        }

        .album{
            margin-bottom: 220px !important;
        }

    }
   









    .lisos-fixed{


        position: sticky;
        position: -webkit-sticky;           

        /*-webkit-position: sticky;*/

        left: 0;
        /*bottom: 0;*/
        width: 100%;
        background-color: white;
        z-index: 100;
    }

    .nav-zoom{
        width:2em;
    }
    .owl-next{
        right: 20px !important;
    }
    .owl-prev{
        left:20px !important;
    }

    .swiper-button-next{
        top:48%;
    }
    .swiper-button-prev{
        top:48%;

    }

    .product-hover-overlay{
        display: block;
    }


    .codigo-lisos{
        font-size:1rem !important;
        text-align: right !important; 
        padding-right: 10px;

    }

    .product-code-texsim{
        font-family: 'dinbold';
        position:absolute;
        /*display: block;*/
        /*margin:35px auto;*/
        /*float:right;*/
        width:100%;
        margin-top: 10px;
        /*font-size:0.9rem;*/
        /*text-align: right;*/ 
    }
    .zoom-texsim
    {
        position: relative;
        top: 40%;
        color: lightgray !important;
        /*font-size: 0.9em;*/
        text-align: center;
    }
    .zoom-texsim:hover{
        color: white !important ;
    }


    .product-hover-overlay .product-hover-overlay-buttons-texsim {
        width: 100%;
        height: 100%;
        position: absolute;
        margin-top: auto;
        margin-bottom: auto;
        /*margin-top: 0;*/ 
        z-index: 3; 
    }

    .product-hover-overlay .btn{
        /*font-size: 1.8rem;*/
        /*width: 50%;*/
        /*height: 50%;*/
        /*line-height: 50%;*/
        letter-spacing: 0;
        padding: inherit;
        margin: inherit;
        border: none;
        color: white;
    }


    .swiper-pagination-progressbar .swiper-pagination-progressbar-fill{
        background: <?= $color ?>;
    }
    .swiper-button-next{
        background-image:  url("img/flechader.svg");
        /*        background-size: 4em;*/
        width: 4em;
        height: 4em;
        border: none !important;
    }
    .swiper-button-prev{
        background-image:  url("img/flechaizq.svg");
        /*        background-size: 4em;*/
        width: 4em;
        height: 4em;
        border: none !important;
    }
</style>

