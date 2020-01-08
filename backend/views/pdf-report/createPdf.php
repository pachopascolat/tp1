
<?php

use yii\widgets\ActiveForm;

\backend\assets\AppAsset::register($this);

$js = '
filtrarVidriera = function(){
$.get({url:"create-pdf",data:$("form").serialize()});
}

exportar = function(url){
$.post({
    url:url,
    data: $("form").serialize(),
});
}

';

$this->registerJs($js);
//$this->registerJs($js2);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div>

    <?php $form = ActiveForm::begin(['id' => 'export-pdf']);
    ?>

    <button style="display: none" type="button" class="btn btn-warning toggle-deseleccionar ">Deseleccionar Todo</button>

    <!--<button id="zip-button" type="submit" class="btn btn-primary" >ZIP</button>-->

    <?php
//    $model = new common\models\PdfReport();
    echo $form->field($model, 'header')->fileInput(['class' => 'form-control']);
    echo $form->field($model, 'header2')->fileInput(['class' => 'form-control']);
//    echo $form->field($model, 'tela_id')->hiddenInput()->label(false);
    $vidrieras = common\models\Vidriera::find()->joinWith('categoria')->where(['nombre_categoria' => 'PDF'])->all();
    $items = \yii\helpers\ArrayHelper::map($vidrieras, 'id_vidriera', 'nombre');
    echo $form->field($model, 'vidriera_id')->dropDownList($items,[
//        'onChange'=> "",
        'onChange'=> "filtrarVidriera()",
    ]);
    echo $form->field($model, 'nombre_pdf')->textInput();
    echo $form->field($model, 'guardar')->checkbox();
//    echo $form->field($model, 'guardar')->checkbox();
    ?>
    <button id="pdf-button" name="pdf-button" 
            type='submit'
            class="btn btn-success"
            >PDF</button>

    <?php ActiveForm::end(); ?>
    <?php echo $this->render('/vidriera/_items_vidriera',['vidriera'=>$model->vidriera??new common\models\Vidriera()])?>
</div>
