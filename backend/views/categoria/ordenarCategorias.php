<?php
$js2 = '    

        $( "#sortable" ).on( "sortupdate", function( event, ui ) {
            var sortedIDs = $( "#sortable" ).sortable( "toArray" );
            $.post("/admin/categoria/ordenar-categorias", { "items": sortedIDs } );
        } );

        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
          } );'
        . '';
//$this->registerJs($js);
$this->registerJs($js2);

//$this->params['breadcrumbs'][] = ['']
$this->params['breadcrumbs'][] = ['url'=>['index'],'label'=>'Categorias'];
$this->params['breadcrumbs'][] = ['url'=>['index','categoria_padre'=>$categoria->id_categoria??''],'label'=>$categoria->nombre_categoria??''];


?>



<h1> Ordenar <?= $categoria->nombre_categoria??'';?> </h1>

<div id="" class="">

    <ol id="sortable"  class="list-group">
        <?php foreach ($categoria->categorias as $key => $categoria) : ?>
            <li id="<?= $categoria->id_categoria ?>" class="list-group-item"><?= $categoria->nombre_categoria ?></li>
            <?php endforeach; ?>
    </ol>

</div>