<?php
/* @var $this yii\web\View */
/* @var $tela common\models\Tela */

use zxbodya\yii2\galleryManager\GalleryManager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<?php
$nombre_tela = $tela->nombre_tela;

$categoria_padre = 1;

$menus = [null, "Hogar", "Moda"];

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $menus[$categoria_padre]),
    'url' => ['/categoria/index', 'categoria_padre' => $categoria_padre]
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', $tela->categoria->nombre_categoria),
    'url' => ['/tela/index-por-categoria', 'categoria_id' => $tela->categoria_id]
];
$this->params['breadcrumbs'][] = $tela->nombre_tela;
?>

<style>
    .container{
        width:98% !important;
    }
</style>

<?php Pjax::begin(['id' => 'pjax_widget_id']) ?>
<h1><?= $nombre_tela ?></h1>
<p>
    <?= Html::a(Yii::t('app', 'Crear Grupo'), ['crear-grupo', 'tela_id' => $tela->id_tela], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app', 'ver en Frontend'), Yii::$app->urlManagerFrontEnd->createUrl(['designs', 'id' => $tela->id_tela]), ['class' => 'btn btn-primary', 'target' => '_blank', 'data-pjax' => 0]) ?>
</p>
<div class="grupo-div">


    <?php
    $grupo = 1;
    $fila = 0;
//    foreach ($tela->grupos as $key => $model):
    ?>
    <?php
    $buttons = " 
            <p>
                <span class='pull-left btn btn-default '>Grupo $grupo</span>" .
            Html::a(Yii::t('app', 'Borrar Grupo'), ['borrar-grupo', 'tela_id' => $tela->id_tela, 'id' => $model->id_grupo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ]
            ]) .
            "</p>";
    ?>
    <?php
    $form = ActiveForm::begin(['id' => 'grupoform']);
//        $num = $key + 1;
//
//        if ($key % 3 == 0) {
//            $grupo++;
//            $fila = 1;
//            echo $buttons;
//        } else {
//            $fila++;
//        }
    ?>

    <?= $form->field($model, 'columnas')->textInput(['type' => 'number', 'style' => 'width:20%', 'class' => 'columnas-input']); ?>

    <div id="my-widget" class="" style="width: <?= (150 * $model->columnas); ?>px ">

        <?php // echo $form->field($model, 'nombre')->textInput(['value'=>"Grupo $num"])->label(false)  ?>
        <?php // echo $form->field($model, 'tela_id')->hiddenInput(['value'=>$model->tela_id])->label(false)   ?>
        <!--                <div class="col-md-4">
        <?php // echo Html::a(Yii::t('app', 'Editar Nombre'), ['ver-grupos', 'tela_id' => $tela->id_tela, 'id_grupo' => $model->id_grupo ], ['class' => 'btn btn-info btn-sm'])  ?>
        
                        </div>-->


        <?php
        if ($model->isNewRecord) {
            echo 'Can not upload images for new record';
        } else {
            echo GalleryManager::widget(
                    [
//                            'buttons' => $buttons,
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'grupo/galleryApi'
                    ]
            );
        }
        ?>
    </div>

    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>


    <?php ActiveForm::end(); ?>

    <?php // endforeach;  ?>
</div>
<?php Pjax::end() ?>

<?php
$js = "
    $('.columnas-input').change(function () {
        options = {
        type: 'POST',
                url: $('#grupoform').attr('action'),
                container: '#pjax_widget_id',
                data: $('#grupoform').serialize(),
        };
                $.pjax.reload(options);
        });

    $(document).on('ready pjax:success', function () {
        $('.columnas-input').change(function () {
        options = {
        type: 'POST',
                url: $('#grupoform').attr('action'),
                container: '#pjax_widget_id',
                data: $('form').serialize(),
        };
                $.pjax.reload(options);
        });
        });
        ";

$this->registerJs($js);
?>