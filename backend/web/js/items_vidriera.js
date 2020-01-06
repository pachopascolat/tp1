/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $('.items-vidrieras .delete-item-btn').on('click', function () {
        var id = $(this).data('id-item');
        $.pjax.reload({
            push: false,
            replace: false,
            url: 'delete-item?id=' + id,
            type: 'POST',
            data: {id: id},
            container: '#item-vidriera-pjax',
            timeout: false,
        })
    });



//borrar items





//$('.items-vidrieras .delete-item-btn').on('click', function () {
//    var id = $(this).data('id-item');
//    $.post({
//        url: 'delete-item?id=' + id,
//        success: function (res) {
//            $('#item-vidriera-pjax').html(res);
//            var lazyLoadInstance = new LazyLoad({
//                elements_selector: ".lazy"
//                        // ... more custom settings?
//            });
//            lazyLoadInstance.update();
//        }
//    });
//})