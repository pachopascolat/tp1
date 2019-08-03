
<?php
use yii\widgets\ActiveForm;

\backend\assets\AppAsset::register($this);

$js = '
    $( function() {
        $( "#selectable" ).selectable();
    });

$(".toggle-seleccionar").click(function(){
    $(this).hide();
    $(".toggle-deseleccionar").show();
    $("input:checkbox").each(function() {
            this.checked= true;
            var img =  $(this).parent(".ui-widget-content");
            img.addClass("img-selected");
    });
    $(".ui-widget-content").each(function(){
        $(this).addClass("ui-selected");
    });
});

$(".toggle-deseleccionar").click(function(){
    $(this).hide();
    $(".toggle-seleccionar").show();
    $("input:checkbox").each(function() {
            this.checked= false;
            var img =  $(this).parent(".ui-widget-content");
            img.removeClass("img-selected");
    });
    $(".ui-widget-content").each(function(){
        $(this).removeClass("ui-selected");
    });
});
  
$( "#selectable" ).on( "selectablestop", function( event, ui ) {
    $(".ui-selected input:checkbox", this).each(function() {
            this.checked= true;
            var img =  $(this).parent(".ui-widget-content");
            img.addClass("img-selected");
    });
} );
$( "#selectable" ).on( "selectablestart", function( event, ui ) {
    $(".ui-selected input",this).each(function() {
            this.checked= false;
            var img =  $(this).parent(".ui-widget-content");
            img.removeClass("img-selected");
    });
} );
$( "#selectable" ).on( "selectablecreate", function( event, ui ) {
    $("input:checkbox").each(function() {
            $(this).checked= false;
    });
} );

exportar = function(url){
$.post({
    url:url,
    data: $("form").serialize(),
});
}




';
//$this->registerJs($js);
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
    
<!--    <button type="button" class="btn btn-info toggle-seleccionar">Seleccionar Todo</button>
    <button style="display: none" type="button" class="btn btn-warning toggle-deseleccionar ">Deseleccionar Todo</button>
    <button id="pdf-button" type="button" class="btn btn-success" onclick="exportar('<?= yii\helpers\Url::to(['photo-grid','tela_id'=>$tela_id])?>')">PDF</button>
    <button id="zip-button" type="submit" class="btn btn-primary" >ZIP</button>-->
    <div id="selectable"  class="">
        <?php
        foreach ($data as $estampado):
            ?>
            <label class="ui-widget-content">
                <!--<div class="">-->
                <img src="<?= $estampado->getUrl('preview') ?>" >
                <!--</div>-->
                <input value="<?= $estampado->id ?>" class="img-checkbox" type="checkbox" name="estampados[]"/>
                <!--<i class="fa fa-check hidden"></i>-->
                <span class="id-estampado"><?= $estampado->name ?></span>

            </label>
        <?php endforeach; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
