<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\Galeria */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$nombre_tela = $tela->nombre_tela;

$categoria_padre = $tela->categoria->categoria_padre;

$menus = [null, "Hogar", "Moda"];

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $menus[$categoria_padre]),
    'url' => ['/categoria/index', 'categoria_padre' => $categoria_padre]
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $tela->categoria->nombre_categoria),
    'url' => ['/tela/index-por-categoria', 'categoria_id' => $tela->categoria_id]
];
$this->params['breadcrumbs'][] = $tela->getNombreCompleto();
?>

<p>
    <?= Html::a(Yii::t('app', 'Crear Grupo'), ['crear-galeria','tipo'=>$tipo, 'tela_id' => $tela_id], ['class' => 'btn btn-success']) ?>

    <?= Html::a(Yii::t('app', 'ver en Frontend'), Yii::$app->urlManagerFrontEnd->createUrl(['estampados', 'id' => $tela_id]), ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
</p>
<div class="estampado-form">




    <?php
    yii\widgets\Pjax::begin(['id' => 'pjax_widget_id', 'timeout' => 5000]);

    $form = ActiveForm::begin([
                'id' => 'grupoform',
//                'options' => ['data-pjax' => true],
//                'enableAjaxValidation' => true,
    ]);
//    $settings = common\models\Estampado::find()->where(['tela_id' => $tela->id_tela])->orderBy('orden')->all();
    ?>
    <?php foreach ($settings as $index => $model): ?>
        <?php // echo $form->field($model, 'nombre_estampado')->textInput(['maxlength' => true])  ?>

        <?php $model->setColumnas() ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, "[$index]columnas")->textInput(['width' => '50px', 'disabled' => true, 'type' => 'number', 'class' => 'inline columnas-input']) ?>

            </div>
            <div class="col-sm-4">
                <?php echo $form->field($model, "[$index]slides")->textInput(['type' => 'text', 'class' => 'inline columnas-input']) ?>

            </div>
            <div class="col-sm-4">
                <?php echo $form->field($model, "[$index]orden")->textInput(['type' => 'text', 'class' => 'inline columnas-input']) ?>

            </div>
        </div>


        <?php // echo  $form->field($model, 'tela_id')->textInput()      ?>
        <div id="my-widget" class="" style="width: <?= (150 * $model->columnas); ?>px ">
            <p>
                <?php
                if ($model->isNewRecord) {
                    echo 'Can not upload images for new record';
                } else {
                    echo GalleryManager::widget(
                            [
//                            'buttons' => $buttons,
                                'model' => $model,
                                'behaviorName' => 'galleryBehavior',
                                'apiRoute' => 'galeria/galleryApi'
                            ]
                    );
                }
                ?>
            </p>
        </div>

        <div class="form-group">
            <p>
                <?php // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success'])   ?>
                <?=
                Html::a(Yii::t('app', 'Borrar Grupo'), ['borrar-galeria', 'tela_id' => $tela_id, 'id' => $model->id_galeria], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ]
                ]);
                ?>
            </p>
        </div>
    <?php endforeach; ?>
    <?php
    ActiveForm::end();
    $js = "
    $('.columnas-input').change(function (e) {
    e.preventDefault();
        options = {
        type: 'POST',
                url: $('#grupoform').attr('action'),
                container: '#pjax_widget_id',
                data: $('#grupoform').serialize(),
        };
                $.pjax.reload(options);
        });

        ";

    $this->registerJs($js);

    yii\widgets\Pjax::end();
    ?>

</div>
