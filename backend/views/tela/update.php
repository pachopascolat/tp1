<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tela */
$menus = [null, "Hogar", "Moda"];

$this->title = Yii::t('app', 'Update Tela: {name}', [
    'name' => $model->nombre_tela,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $menus[$categoria_padre]), 'url' => ['/categria/index','categoria_padre'=>$categoria_padre]];
//$this->params['breadcrumbs'][] = ['label' => $model->categoria->nombre_categoria, 'url' => ['/tela/index-por-categoria', 'categoria_id' => $model->categoria_id]];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_tela, 'url' => ['update', 'id' => $model->id_tela]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tela-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
//        'categoria_padre' => $categoria_padre,
    ]) ?>

</div>
