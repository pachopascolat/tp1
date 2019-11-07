
//$('.menu-cat-toggle').on('click', function () {
//    var cat = $(this).data('categoria');
//    var collapse = '#collapse' + cat;
//    $(collapse).collapse('show');
//    $(collapse).on('shown.bs.collapse', function () {
//        this.scrollIntoView();
//    });
//})

//$('#collapse7').on('shown.bs.collapse', function () {
//    this.scrollIntoView();
//});

//function mostrarCategoria(id) {
//    var cat = '#collapse' + id
//    $(cat).collapse('show');
//    $(cat).on('shown.bs.collapse', function () {
//        this.scrollIntoView();
//    });
//}

//$('.categoriactiva').on('shown.bs.collapse', function () {
//    this.scrollIntoView();
////    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
////        // you're at the bottom of the page
////    } else {
//        window.scrollBy(0, -180);
////    }
//});
//
//$(document).ready(function () {
//    var categoria = $('.categoriactiva');
//    categoria.collapse('show');
////    categoria.scrollIntoView();
////    window.scrollBy(0, -300);
//
//
//});




jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, {passive: false});
        } else {
            this.addEventListener("touchstart", handle, {passive: true});
        }
    }
};


$('.btn-pjax-modal').on('click', function () {
    var modal_id = $(this).data('modal-id');
    $.pjax.reload({
        container: '#pjax-modal-todos',
        type: 'POST',
        data: {modal_id: modal_id}
    });
//    $.ajax({
//        url: 'delete-item' + "?id=" + itemid,
//        success: function (e) {
//            $('.carrito-count').each(function () {
//                $(this).text(e);
//            });
////            $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
//            if (cart.length) {
//                $.pjax.reload({container: '#cart-pjax'});
//            }
//        }
//    }); 
});


$('.modal form').on('afterValidate', function () {
    $('.spinner-border').addClass("d-none");
})

$('.modal form').on('submit', function () {

    $('.spinner-border').removeClass("d-none");
//    $('.loading-div').addClass("spinner-border-sm");

});

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


$(".sticky-nav").stick_in_parent();
//    $(".lisos-fixed").stick_in_parent();

$('.borrar-carrito').on('click', function (event) {
    event.preventDefault();
    var cart = $('#cart-pjax');
    var message = $(this).data('confirm');
    bootbox.confirm({
        message: message,
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: 'delete-carrito',
                    success: function (e) {
                        $('.carrito-count').each(function () {
                            $(this).text(e);
                        });
//                        $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                        if (cart.length) {
                            $.pjax.reload({container: '#cart-pjax'});
                        }
                    }
                });
            }
        }
    });
});
$('.cart-remove').on('click', function (event) {
    event.preventDefault();
    var cart = $('#cart-pjax');
    var itemid = $(this).data('item-id');
    $.ajax({
        url: 'delete-item' + "?id=" + itemid,
        success: function (e) {
            $('.carrito-count').each(function () {
                $(this).text(e);
            });
//            $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
            if (cart.length) {
                $.pjax.reload({container: '#cart-pjax'});
            }
        }
    });
});
$(document).on('ready pjax:success', function () {
    $('.borrar-carrito').on('click', function (event) {
        event.preventDefault();
        var cart = $('#cart-pjax');
        $.ajax({
            url: 'delete-carrito',
            success: function (e) {
                $('.carrito-count').each(function () {
                    $(this).text(e);
                });
//                $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                if (cart.length) {
                    $.pjax.reload({container: '#cart-pjax'});
                }
            }
        }
        );
    });
    $('.cart-remove').on('click', function (event) {
        event.preventDefault();
        var cart = $('#cart-pjax');
        var itemid = $(this).data('item-id');
        $.ajax({
            url: 'delete-item' + "?id=" + itemid,
            success: function (e) {
                $('.carrito-count').each(function () {
                    $(this).text(e);
                });
//                $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                if (cart.length) {
                    $.pjax.reload({container: '#cart-pjax'});
                }
            }
        });
    });
    $('.cambiar-precio').change(function () {
        var id = $(this).data('id');
        var precio = $(this).val();
        $.post({
            url: 'cambiar-precio',
            data: {id: id, precio: precio}
        })
    });
    $('.btn-items-increase').click(function () {
        var id = $(this).data('id');
        $.post({
            url: 'aumentar-cantidad',
            data: {id: id},
        });
    });
    $('.btn-items-decrease').click(function () {
        var id = $(this).data('id');
        $.post({
            url: 'disminuir-cantidad',
            data: {id: id},
        });
    });
    $('.btn-items-decrease').on('click', function () {
        var input = $(this).siblings('.input-items');
        if (parseInt(input.val(), 10) >= 1) {
            input.val(parseInt(input.val(), 10) - 1);
        }
    });

    $('.btn-items-increase').on('click', function () {
        var input = $(this).siblings('.input-items');
        input.val(parseInt(input.val(), 10) + 1);
    });
});






$('.cambiar-precio').change(function () {
    var id = $(this).data('id');
    var precio = $(this).val();
    $.post({
        url: 'cambiar-precio',
        data: {id: id, precio: precio}
    })
});
$('.btn-items-increase').click(function () {
    var id = $(this).data('id');
    $.post({
        url: 'aumentar-cantidad',
        data: {id: id},
    });
});
$('.btn-items-decrease').click(function () {
    var id = $(this).data('id');
    $.post({
        url: 'disminuir-cantidad',
        data: {id: id},
    });
});
$('#collapseContacto').on('shown.bs.collapse', function () {
    this.scrollIntoView();
});
$('.modal-disenios').on('show.bs.modal', function (event) {
    var id = $(this).data('id');
    var owl = $('#modelos-slider' + id);
    owl.trigger('to.owl.carousel', [0, 0]);
    owl.trigger('refresh.owl.carousel');
});
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
        url: 'agregar-item',
        data: form.serialize(),
        success: function (e) {
            $('.carrito-count-div').each(function () {
                $(this).removeClass('d-none');
            })

            $('.carrito-count').each(function () {
                $(this).text(e);
            })
            //$.pjax.reload({container: '#carrito-pjax', 'timeout': false});
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
//        onInitialized: callback,
    onTranslated: callback,
    onRefresh: callback,
//        onToOwlCarrousel:callback,
//        onDragged:callback,
//        onChange: callback,

});
function callback(event) {
    if (event.item.count > 1) {

        var element = event.target;
        var target = event.relatedTarget;
        var carrousel = target.$element;
        var active = carrousel.find('div.owl-item.active > div');
//        var active = element.find('div.owl-item.active > div');
//        active = item
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
        h3codigo.text(code + " " + name);
        idInput.val(id);
    }
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
