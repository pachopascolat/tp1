<div class="form-group" id="add-item-vidirera">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'ItemVidirera',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'id_item_vidriera' => ['type' => TabularForm::INPUT_HIDDEN],
        'articulo_id' => [
            'label' => 'Articulo',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Articulo::find()->orderBy('id_articulo')->asArray()->all(), 'id_articulo', 'id_articulo'),
                'options' => ['placeholder' => 'Choose Articulo'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'imagen_id' => [
            'label' => 'ImageManager',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ImageManager::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose ImageManager'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'orden_item_vidriera' => ['type' => TabularForm::INPUT_TEXT],
        'ranking' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowItemVidirera(' . $key . '); return false;', 'id' => 'item-vidirera-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Item Vidirera', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowItemVidirera()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

