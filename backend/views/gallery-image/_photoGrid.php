
<?php
use yii\widgets\ActiveForm;

\backend\assets\AppAsset::register($this);

$js = '
    $( function() {
        $( "#selectable" ).selectable();
    });

$(".toggle-seleccionar").click(function(){
    $("input:checkbox").each(function() {
            this.checked= true;
            var img =  $(this).parent(".ui-widget-content");
            img.addClass("img-selected");
    });
});
  
$( "#selectable" ).on( "selectablestop", function( event, ui ) {
    $(".ui-selected input", this).each(function() {
            this.checked= true;
            var img =  $(this).parent(".ui-widget-content");
            img.addClass("img-selected");
    });
} );
$( "#selectable" ).on( "selectablestart", function( event, ui ) {
    $(".ui-selected input", this).each(function() {
            this.checked= false;
            var img =  $(this).parent(".ui-widget-content");
            img.removeClass("img-selected");
    });
} );
$( "#selectable" ).on( "selectablecreate", function( event, ui ) {
    $("input", this).each(function() {
            this.checked= false;
    });
} );

//$("input:checkbox").change(function() {
//    var img =  $(this).parent(".ui-widget-content");
//    if(!this.checked) {
//        img.removeClass("img-selected");
//
//    }else{
//        img.addClass("img-selected");
//    }
//});




';
$this->registerJs($js);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>



    img{
        /*padding:  10px;*/
        /*margin: 5px;*/
        width: 100px;
    }
    .img-selected{
        border: 4px blue solid !important;
    }
    #feedback { font-size: 1.4em; }
    #selectable .ui-selecting img { 
        /*background: #FECA40;*/ 
        opacity: 0.5;
        filter: alpha(opacity=50);
    }
    #selectable .ui-selected img{ 
        /*background: blue;*/           
        color: white;
        opacity: 1;
        filter: alpha(opacity=100);
        /*border: 5px blue solid;*/
    }
    #selectable input{
        position: absolute;
        top: 0;
        right: 0;
    }

    .ui-widget-content{
        position: relative;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 4px solid transparent;
        margin-bottom: 4px;
        outline: 0;
    }
    .id-estampado {
        position: absolute;
        /*color: #4A79A3;*/
        background-color: #fff;
        padding: 4px;
        bottom: 0 ;
        right: 0px;
        
    }


</style>
<div >
    <?php $form = ActiveForm::begin();
    ?>
    
    <button class="btn btn-info toggle-seleccionar">Seleccionar Todo</button>
    <button type="submit" class="btn btn-success">Enviar</button>
    <div id="selectable"  class="">
        <?php
        foreach ($data as $estampado):
            ?>
            <label class="ui-widget-content">
                <!--<div class="">-->
                <img src="<?= $estampado->getUrl('preview') ?>" >
                <!--</div>-->
                <input value="<?= $estampado->id ?>" class="img-checkbox hide" type="checkbox" name="estampados[]"/>
                <!--<i class="fa fa-check hidden"></i>-->
                <span class="id-estampado"><?= $estampado->id ?></span>

            </label>
        <?php endforeach; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
