<div class="siete-filas-principal">
    <div class="container">
        <div class="d-flex">
            <!--left-->
            <div class="flex-2 sidebar-menu" id="leftCol">

                <?= $this->render('sidebarMenu') ?>
            </div><!--/left-->
            <div class="" style="flex: 9">
                <h1 class="pl-1 pb-3"> <?= $vidriera->nombre ?> </h1>
                <?= $this->render('GridSieteFilas',['vidriera'=>$vidriera]) ?>
            </div><!--right-->          
        </div><!--fin row-->    
    </div>
</div>   