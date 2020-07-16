$(document).ready(function () {
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
                // ... more custom settings?
    });
    lazyLoadInstance.update();
//borrar todo


    
    
    

    $('.items-borrar-todo').click(function () {
        bootbox.confirm("Esta seguro de borrar todos los items?", function (result) {
            if (result) {
                var idList = [];
                var delbtn = $('.items-vidrieras .delete-item-btn');
                delbtn.each(function () {
                    idList.push($(this).data('id-item'));
                });
                $.pjax.reload({
                    push: false,
                    replace: false,
                    url: '/admin/vidriera/delete-all-items',
                    type: 'POST',
                    data: {ids: idList},
                    container: '#item-vidriera-pjax',
                    timeout: false,
                    async: false,
                })
            }
        })
    });
// deseleccionar todo

    $(".items-vidrieras-div .modal").on('hidden.bs.modal', function () {
        $('.selectable').prop('disabled', true);
        $('.selected').removeClass('selected');
    });
//agregar items

    $('.items-vidrieras-div .agregar-item-btn').click(function () {
        var id = $(this).data('id-vidriera');
        $.pjax.reload({
            push: false,
            replace: false,
            url: '/admin/vidriera/agregar-items?id=' + id,
            type: 'POST',
            data: $('#nuevo-item-form').serialize(),
            container: '#item-vidriera-pjax',
            timeout: false,
            async: false,
        })
        $('.modal').modal('hide');
    });
//filtrar por tela y articulo

    $('.modal .filters').on('change', function () {
        $.pjax.reload({
            push: false,
            replace: false,
            url: '/admin/vidriera/filtrar-articulos',
            type: 'GET',
            data: $('#nuevo-item-form').serialize(),
            container: '#items-pjax',
            timeout: false,
        })
    });
//filtrar imagenes de galeria

    $('.modal .galery-filter').on('change', function () {
        $.pjax.reload({
            url: '/admin/vidriera/filtrar-imagenes',
            push: false,
            replace: false,
            type: 'GET',
            data: $('#galeria-form').serialize(),
            container: '#galeria-pjax',
            timeout: false,
        })
    });
    //cambiar la imagen del item

    $('.items-vidrieras-div .cambiar-imagen-btn').on('click', function () {
        var id = $(this).data('id-item');
        $.pjax.reload({
            push: false,
            replace: false,
            url: '/admin/vidriera/cambiar-imagen?id=' + id,
            type: 'POST',
            data: $('#galeria-form').serialize(),
            container: '#item-vidriera-pjax',
            timeout: false,
        })
        $('.modal').modal('hide');
    });
    //seleccionar los items nuevos


//seleccionar las imagenes a cambiar



})

$(document).on('pjax:success', function () {
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
                // ... more custom settings?
    });
    lazyLoadInstance.update();
// seleccionar items nuevos


//seleccionar las imagenes a cambiar



})
