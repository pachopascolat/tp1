
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
  

exportar = function(url){
$.post({
    url:url,
    data: $("form").serialize(),
});
}




';
$js2 = '
$(".sacar-pdf").click(function(){
    var id = $(this).data("iddisenio");
    var disenio = $("#"+id); 
    disenio.remove();
});    
$( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );'
        . '';
$this->registerJs($js);
$this->registerJs($js2);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>

</script>
<style>



    img{
        /*position: absolute;*/
        /*padding:  10px;*/
        /*margin: 5px;*/
        width: 100px;
    }
    .img-selected{
        /*border: 4px blue solid !important;*/
    }
    #feedback { font-size: 1.4em; }
    #sortable .ui-selecting img { 
        /*background: #FECA40;*/ 
        opacity: 0.5;
        filter: alpha(opacity=50);
    }
    #sortable .ui-selected img{ 
        /*background: blue;*/           
        color: white;
        opacity: 1;
        filter: alpha(opacity=100);
        /*border: 5px blue solid;*/
    }
    #sortable input{
        position: absolute;
        top: 0;
        right: 0;
    }

    .ui-widget-content{
        display: inline-block;
        position: relative;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        /*border: 4px solid transparent;*/
        /*margin-bottom: 4px;*/
        outline: 0;
        left: 0px;
        top: 0px;
        margin: 0.5em;
    }
    .id-estampado {
        position: absolute;
        /*color: #4A79A3;*/
        background-color: #fff;
        padding: 4px;
        bottom: 1px ;
        right: 1px;

    }
    .sacar-pdf{
        /*background-color: transparent;*/
        position: absolute;
        top:0;
        right: 0;
        color:red;
    }


</style>
<div>
    <?php $form = ActiveForm::begin(['id' => 'export-form']);
    ?>

    <!--<button type="button" class="btn btn-info toggle-seleccionar">Seleccionar Todo</button>-->



    <?php
    $telas = common\models\Tela::getTelasLlenas();
    $items = yii\helpers\ArrayHelper::map($telas, 'id_tela', 'nombre_tela');
    echo $form->field($searchModel, 'tela_id')->dropDownList($items, [
        'onchange' => '$("#export-form").submit()',
        'prompt' => 'Seleccione una tela'
//        'multiple' => 'multiple'
    ]);
//    echo \yii\helpers\Html::activeDropDownList($searchModel, 'codigo_tela', $items);
    ?>

    <button style="display: none" type="button" class="btn btn-warning toggle-deseleccionar ">Deseleccionar Todo</button>

    <!--<button id="zip-button" type="submit" class="btn btn-primary" >ZIP</button>-->

    <?php
//    $model = new common\models\PdfReport();
    echo $form->field($model, 'header')->fileInput(['class' => 'form-control']);
    echo $form->field($model, 'header2')->fileInput(['class' => 'form-control']);
    echo $form->field($model, 'tela_id')->hiddenInput()->label(false);
    echo $form->field($model, 'nombre_pdf')->textInput();
    echo $form->field($model, 'guardar')->checkbox();
    ?>
    <button id="pdf-button" 
            type="submit" 
            class="btn btn-success" 
            >PDF</button>
    <div id="sortable"  class="">
        <?php
        foreach ($data as $estampado):
            ?>
            <div id="<?= $estampado->id ?>" class="ui-widget-content">
                <!--<div class="">-->
                <img src="<?= $estampado->getUrl('preview') ?>" >
                <!--</div>-->
                <input value="<?= $estampado->id ?>" class="img-checkbox" type="hidden" name="estampados[]"/>
                <!--<input value="<?= $estampado->id ?>" class="img-checkbox" type="checkbox" name="estampados[]"/>-->
                <button data-iddisenio="<?= $estampado->id ?>"  type="button" class="sacar-pdf" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>                <!--<i class="fa fa-check hidden"></i>-->
                <span class="id-estampado"><?= $estampado->name ?></span>

            </div>
        <?php endforeach; ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
