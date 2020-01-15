<?php
$js2 = '    

        $( "#sortable" ).on( "sortupdate", function( event, ui ) {
            var sortedIDs = $( "#sortable" ).sortable( "toArray" );
            $.post("/admin/categoria/ordenar-vidrieras", { "items": sortedIDs } );
        } );

        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
          } );'
        . '';
//$this->registerJs($js);
$this->registerJs($js2);

//$this->params['breadcrumbs'][] = ['']
$this->params['breadcrumbs'][] = ['url'=>['/vidriera/index'],'label'=>'Vidrieras'];
$this->params['breadcrumbs'][] = ['url'=>['/vidriera/index','categoria_id'=>$categoria->id_categoria],'label'=>$categoria->nombre_categoria];

//$vidrierasList = [];
//foreach ($categoria->categorias as $cat){
//    foreach ($cat->vidrieras as $vid){
//        $vidrierasList[] = $vid;
//    }
//}
//
//foreach ($categoria->vidrieras as $vidrieras){
//    $vidrierasList[] = $vidrieras;
//}
//

?>



<h1> Ordenar <?= $categoria->nombre_categoria;?> </h1>

<div id="" class="">

    <ol id="sortable"  class="list-group">
        <?php foreach ($dataProvider->getModels() as $key => $vidriera) : ?>
            <li id="<?= $vidriera->id_vidriera ?>" class="list-group-item"><?= $vidriera->nombre ?></li>
            <?php endforeach; ?>
    </ol>

</div>