<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vidriera */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'ItemVidirera',
        'relID' => 'item-vidirera',
        'value' => \yii\helpers\Json::encode($model->itemVidireras),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="vidriera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?php //  $form->field($model, 'id_vidriera')->textInput(['placeholder' => 'Id Vidriera']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Nombre']) ?>

    <?php //  $form->field($model, 'estado')->textInput(['placeholder' => 'Estado']) ?>

    <?php
    if ($model->categoria_id != common\models\Categoria::findOne(['nombre_categoria'=>'PDF'])->id_categoria) {
        echo
        $form->field($model, 'categoria_id')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Categoria::find()->orderBy('id_categoria')->asArray()->all(), 'id_categoria', 'nombre_categoria'),
            'options' => ['placeholder' => 'Choose Categoria'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }
    ?>

    <?php //  $form->field($model, 'orden_vidriera')->textInput(['placeholder' => 'Orden Vidriera']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('ItemVidirera'),
            'content' => $this->render('_formItemVidirera', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->itemVidireras),
            ]),
        ],
    ];
//    echo kartik\tabs\TabsX::widget([
//        'items' => $forms,
//        'position' => kartik\tabs\TabsX::POS_ABOVE,
//        'encodeLabels' => false,
//        'pluginOptions' => [
//            'bordered' => true,
//            'sideways' => true,
//            'enableCache' => false,
//        ],
//    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
