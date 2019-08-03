<script>
    $('.filtrar-telas').change(function () {
        var id = $(this).val();
        var url = 'designs?id=' + id;
        if (url) {
            window.location = url;
        }
        return false;
//        $("#filtro-telas").submit();
    });

    //mostrar y esconder lisos
    function vermostrar(e) {
        $('#ocultar-lisos-span').hide();
        $('#mostrar-lisos-span').removeClass('d-none');
        $('#mostrar-lisos-span').show();
    }
    function verocultar(e) {
        $('#mostrar-lisos-span').hide();
        $('#ocultar-lisos-span').show();
    }
    $('.collapse').on('hidden.bs.collapse', vermostrar);
    $('.collapse').on('shown.bs.collapse', verocultar);






    $(document).on('ready pjax:success', function () {

        var notice = $('.tooltiptext-notice');
        notice.fadeIn('slow', function () {
            notice.delay(1000).fadeOut();
        });
    });
//acomada cuando no anda sticky
    $(document).ready(function () {
        var $win = $(window);
        var divlisos = $('.lisos-fixed');
        $win.scroll(function (e) {
            if ($(window).width() >= 1025) {
                if ($win.scrollTop() == 0) {
                    console.log('Scrolled to Page Top');
//            divlisos.css({position: 'fixed !important'}).show();
                } else if ($win.height() + $win.scrollTop()
                        == $(document).height()) {
//                    e.preventDefault();
                    console.log('Scrolled to Page Bottom');
                    divlisos.attr('style', 'bottom:0 !important;');
//                    $('.album').attr('style', 'margin-bottom:220px !important');
                } else {
//                    e.preventDefault();
//                    divlisos.css({position: 'fixed !important'}).show();
                    divlisos.attr('style', 'bottom:-100px !important');
//                    $('.album').attr('style', 'margin-bottom:0px !important');
                }
            }
        });
    });


//agrega item a carrito
    $('.submit-zoom').on('click', function () {
        var form = $(this).closest('form');
        var mymodal = $(this).closest('.modal');
//        var id = $('#modal-disenio-id').val();
//        var cantidad = $('#modal-cantidad').val();
//        var data = form.serialize();
//        
        $.ajax({
            type: 'POST',
            url: '<?= \yii\helpers\Url::to(['agregar-item']) ?>',
            data: form.serialize(),
            success: function (e) {
                $.pjax.reload({container: '#carrito-pjax', 'timeout': false});
            }
        });
//                        $.pjax.reload(options);
        mymodal.modal("hide");
    });






//carrousel del zoom cambia los codigos al pasar los modelos
    $('.owl-carousel').owlCarousel({
        dots: false,
        items: 1,
        nav: true,
        navText: ["<img class='nav-zoom' src='img/flechaizq.svg'>", "<img class='nav-zoom' src='img/flechader.svg'>"],
//                    onInitialized: counter,
        onTranslated: callback,
        onRefresh: counter,
        onDragged:
                callback

    });
    function callback(event) {
        var target = event.relatedTarget;
        var carrousel = target.$element;
        var active = carrousel.find('div.owl-item.active > div');
//        var code;
//        var id;
        var oferta, agotado, id, code;
        var code = active.data('code');
        var name = active.data('nombre');
        var id = active.data('id');
        var oferta = active.data('oferta');
        var agotado = active.data('agotado');

        var modal = carrousel.closest('.modal');
        var idInput = modal.find('.modal-disenio-id');
        var h3codigo = modal.find('.modal-disenio-codigo');
        var cantInput = modal.find('.modal-cantidad');
        var ribonOferta = modal.find('.ribbon-oferta');
        var ribonAgotado = modal.find('.ribbon-agotado');
        if (agotado) {
            ribonOferta.addClass('d-none');
            ribonAgotado.removeClass('d-none')
        } else {
            if (oferta) {
                ribonAgotado.addClass('d-none')
                ribonOferta.removeClass('d-none')
            } else {
                ribonOferta.addClass('d-none');
                ribonAgotado.addClass('d-none')
            }
        }


        cantInput.val(1);
        h3codigo.text(code+" "+name);
        idInput.val(id);
        counter(event);
//                    console.log(code);
    }

    function counter(event) {

        var element = event.target; // DOM element, in this example .owl-carousel
        var items = event.item.count; // Number of items
        var item = event.item.index + 1; // Position of the current item

        // it loop is true then reset counter from 1
        if (item > items) {
            item = item - items
        }
        var target = event.relatedTarget;
        var carrousel = target.$element;
        var modal = carrousel.closest('.modal');
        var cantItems = modal.find('.cant-modelos');
        cantItems.html("item " + item + " de " + items);
    }




//arma tantos swiper como grupos de estampados hay
<?php foreach ($model->getSliders() as $key => $galeria): ?>
        var swiper<?= $key ?> = new Swiper('.swiper<?= $key ?>', {
    <?php
    $cantidad = count($galeria);
    if ($cantidad <= 7) {
        $slidesPerColumnMovil = 1;
    } elseif ($cantidad <= 11) {
        $slidesPerColumnMovil = 2;
    } else {
        $slidesPerColumnMovil = 3;
    }
    if ($cantidad <= 11) {
        $slidesPerColumn = 1;
    } elseif ($cantidad <= 17) {
        $slidesPerColumn = 2;
    } else {
        $slidesPerColumn = 3;
    }
    ?>
            preloadImages: false,
            // Enable lazy loading
            lazy: true,
            watchSlidesVisibility: true,
            grabCursor: true,
            slidesPerView: 6,
            spaceBetween: 8,
            //            slidesPerColumn: 1,
            slidesPerColumnFill: 'row',
            //            centerInsufficientSlides:true,
            pagination: {
                type: 'progressbar',

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
                    slidesPerColumn: <?= $slidesPerColumnMovil ?>,

                    //                        slidesPerColumn: 3,

                },
                // when window width is >= 480px
                480: {
                    slidesPerColumn: <?= $slidesPerColumnMovil ?>,
                    slidesPerView: 4,
                    spaceBetween: 4,
                    //                        slidesPerColumn: 3,

                },
                // when window width is >= 640px
                520: {
                    slidesPerColumn: <?= $slidesPerColumn ?>,
                    slidesPerView: 6,
                    spaceBetween: 6,
                    //                        slidesPerColumn: 3,

                },
                980: {
                    slidesPerColumn: <?= $slidesPerColumn ?>,
                    slidesPerView: 6,
                    spaceBetween: 8,
                    //                        slidesPerColumn: 3,

                }
            }
        });
        //                    mySwiper.on('imagesReady', function () {
        //                        console.log('slide changed');
        //                    });
<?php endforeach; ?>


//swiper para los lisos
    var swiperLisos = new Swiper('.swiper-lisos', {
//        initialSlide: 1,
//        roundLengths: true,
        loop: true,
//        loopAdditionalSlides: ,
        centeredSlides: true,
//        loop: true,
        preloadImages: false,
        // Enable lazy loading
        lazy: true,
        watchSlidesVisibility: true,
        slidesPerView: 8,
        spaceBetween: 4,
        breakpointsInverse: true,
//        navigation: {
//            nextEl: '.swiper-button-next',
//            prevEl: '.swiper-button-prev'
//        },
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