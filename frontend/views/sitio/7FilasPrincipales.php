<div class="siete-filas-principal">
    <div class="container">
        <div class="d-flex">
            <!--left-->
            <div class="flex-2 sidebar-menu d-none d-md-block" id="leftCol">
                <?= $this->render('sidebarMenu') ?>
            </div><!--/left-->
            <div class="" style="flex: 9">
                <h1 class="pl-1 pb-3"> <?= $vidriera->nombre ?> </h1>
                           
               <div class="d-sx-block d-md-none">
                    <?php echo $this->render('GridSieteFilas', ['vidriera' => $vidriera, 'columnas' => 4]) ?>
                </div>
               <div class="d-none d-md-block d-lg-none">
                    <?php echo $this->render('GridSieteFilas', ['vidriera' => $vidriera, 'columnas' => 5]) ?>
                </div>
               <div class="d-none d-lg-block">
                    <?php echo $this->render('GridSieteFilas', ['vidriera' => $vidriera, 'columnas' => 7]) ?>
                </div>
            </div><!--right-->          
        </div><!--fin row-->    
    </div>
</div>   
<?php echo $this->render('_modalItem', ['items' => $vidriera->itemVidireras]) ?>
