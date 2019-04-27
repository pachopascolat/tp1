
<footer class="text-muted">
    <div class="container">
        <div id="scrollTop"><i class="fa fa-long-arrow-alt-up"></i></div>

    </div>
</footer>
<script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function (e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
        }
    }
    // this is set to Bootsstrapious website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://demo.bootstrapious.com/sell/1-2-0/icons/orion-svg-sprite.svg');

</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/swiper.min.js"></script>

<script src="js/owl.carousel.js"></script>
<script src="js/owl.carousel2.thumbs.min.js"></script>

<script src="js/jquery.pjax.js"></script>
<script src="js/smooth-scroll.polyfills.min.js"></script>
<script src="js/ofi.min.js"></script>
<script src="js/theme.js"></script>
<script src="js/bootbox.min.js"></script>
<script src="js/bootbox.locales.min.js"></script>
<script src="js/jquery.pjax.js"></script>
<!--<script src="js/fixedsticky.js"></script>-->
<!--<script src="js/stickybits.min.js"></script>-->
<script src="js/jquery.sticky-kit.js"></script>


<script>

//stickybits('selector', {parentClass: 'album'});
//stickybits('div.lisos-fixed', {
////    parentClass: 'album',
////    stuckClass: 'lisos-fixed',
//    verticalPosition: 'bottom'
//    });



//    stickybits('.lisos-fixed',{verticalPosition: 'bottom'});
//    stickybits('.sticky-nav');

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
                        url: '<?= \yii\helpers\Url::to('delete-carrito') ?>',
                        success: function () {
                            $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                            if (cart.length) {
                                $.pjax.reload({container: '#cart-pjax', async: false, 'timeout': false});
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
            url: '<?= \yii\helpers\Url::to('delete-item') ?>' + "?id=" + itemid,
            success: function (result) {
                $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                if (cart.length) {
                    $.pjax.reload({container: '#cart-pjax', async: false, 'timeout': false});
                }
            }
        });
    });



    $(document).on('ready pjax:success', function () {
        $('.borrar-carrito').on('click', function (event) {
            event.preventDefault();
            var cart = $('#cart-pjax');
            $.ajax({
                url: '<?= \yii\helpers\Url::to('delete-carrito') ?>',
                success: function () {
                    $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                    if (cart.length) {
                        $.pjax.reload({container: '#cart-pjax', async: false, 'timeout': false});
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
                url: '<?= \yii\helpers\Url::to('delete-item') ?>' + "?id=" + itemid,
                success: function (result) {
                    $.pjax.reload({container: '#carrito-pjax', async: false, 'timeout': false});
                    if (cart.length) {
                        $.pjax.reload({container: '#cart-pjax', async: false, 'timeout': false});
                    }
                }
            });
        });
        
        
        

    });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

