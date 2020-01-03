$(document).ready(function () {
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
                // ... more custom settings?
    });

    lazyLoadInstance.update();
});



$('.modal').on('show.bs.modal', function () {
    var img = $(this).find('img');
    img.attr('src', img.data('src'));
});

$('.submit-zoom').on('click', function () {
    var form = $(this).closest('form');
    var mymodal = $(this).closest('.modal');

    $.ajax({
        type: 'POST',
        url: '/sitio/agregar-item',
        data: form.serialize(),
        success: function (e) {
            $('.carrito-count-div').each(function () {
                $(this).removeClass('d-none');
            });

            $('.carrito-count').each(function () {
                $(this).text(e);
            });
            consultaguardada();
        }
    });
//                        $.pjax.reload(options);
    mymodal.modal("hide");
});

consultaguardada = function () {
    var notice = $('.tooltiptext-notice');
    notice.fadeIn('slow', function () {
        notice.delay(1000).fadeOut();
    });
}

$('.cart-remove').on('click', function (event) {
    event.preventDefault();
    var cart = $('#cart-pjax');
    var id = $(this).data('item-id');
    $.ajax({
        url: '/sitio/delete-item',
        type: 'POST',
        data: {id: id},
        success: function (e) {
            var count = $('#item-carrito-count');
            var oldcant = count.text();
            var newcant = parseInt(oldcant) - 1;
            if (newcant == 0) {
                $('.carrito-count-div').remove();
            } else {
                count.text(newcant);
            }
            $('#' + e).remove();
        }
    });
});

$('.btn-items-decrease').click(function () {
    var id = $(this).data('id');
    var input = $(this).siblings('.input-items');
    $.post({
        url: '/sitio/disminuir-cantidad',
        data: {id: id},
        success: function (e) {
            input.val(e)

        }
    });
});
$('.btn-items-increase').click(function () {
    var id = $(this).data('id');
    var input = $(this).siblings('.input-items');
    $.post({
        url: '/sitio/aumentar-cantidad',
        data: {id: id},
        success: function (e) {
            input.val(e)

        }
    });
});
//$('.btn-items-decrease').on('click', function () {
//    var input = $(this).siblings('.input-items');
//    if (parseInt(input.val(), 10) >= 1) {
//        input.val(parseInt(input.val(), 10) - 1);
//    }
//});
$('.btn-items-increase').on('click', function () {
    var input = $(this).siblings('.input-items');
    input.val(parseInt(input.val(), 10) + 1);
});