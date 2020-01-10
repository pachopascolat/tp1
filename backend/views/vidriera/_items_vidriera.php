<!--<h1><?= $vidriera->nombre ?></h1>-->
    
<div >
    <?php
    yii\widgets\Pjax::begin(['id' => 'item-vidriera-pjax',
//        'enablePushState' => false,
//        'enableReplaceState' => false,
    ])
    ?>
<script>
    
</script>
    
    <?php
    $js = "
            
                
      
             $('.items-vidrieras .delete-item-btn').click(function () {
                var id = $(this).data('id-item');
                $.pjax.reload({
                    push: false,
                    replace: false,
                    url: '/admin/vidriera/delete-item?id=' + id,
                    type: 'POST',
                    data: {id: id},
                    container: '#item-vidriera-pjax',
                    timeout: false,
                    async: false,
                })
            });
             $('.modal-images-link').click(function () {
                var id = $(this).data('id-item');
//                var input = $('.modal-body #id-item');
//                input.val(id);
                var btn = $('.cambiar-imagen-btn');
                btn.data('id-item', id);
            });
                
             
    ";
    $this->registerJs($js);
    $js2 = '    

        $( "#sortable" ).on( "sortupdate", function( event, ui ) {
            var sortedIDs = $( "#sortable" ).sortable( "toArray" );
            $.post("/admin/vidriera/ordenar-items", { "items": sortedIDs } );
        } );

        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
          } );'
            . '';
//$this->registerJs($js);
    $this->registerJs($js2);
    ?>

    <div id='sortable' class="d-flex">
        <?php
        foreach ($vidriera->itemVidireras as $item):
            $url = Yii::$app->imagemanager->getImagePath($item->imagen_id ?? null, 120, 120);
            ?>
            <div id="<?= $item->id_item_vidriera ?>" class="items-vidrieras">
                <!--<img class="lazy img-fluid" data-src="<?= $url ?>">-->
                <img class="img-fluid" src="<?= $url ?>">
                <a data-pjax=0 data-id-item="<?= $item->id_item_vidriera ?>" data-confirm="Esta seguro quiere borrar item?" class="delete-item-btn" >
                <i data-id-item="<?= $item->id_item_vidriera ?>" class="fa fa-times fa-2x"></i>
                </a>
                <a data-pjax=0 class="modal-images-link" data-id-item="<?= $item->id_item_vidriera ?>" data-toggle="modal" data-target="#modal-imagenes-galeria" >
                    <i class="fa fa-image fa-2x"></i>
                </a>
                </button>
                <span class="<?= $item->articulo->existencia?'':'text-danger'?>"><?= "{$item->articulo->codigo_color} {$item->articulo->nombre_color}" ?></span>
            </div>

        <?php endforeach; ?>    
    </div>
    <?php yii\widgets\Pjax::end() ?>
</div>