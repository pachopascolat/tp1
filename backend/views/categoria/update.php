<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Categoria */


$this->title = Yii::t('app', 'Update Categoria: {name}', [
    'name' => $model->id_categoria,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->categoriaPadre->nombre_categoria ), 'url' => ['index','categoria_padre'=>$model->categoria_padre]];
//$this->params['breadcrumbs'][] = 'Categoria';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categoria' ), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->nombre_categoria, 'url' => ['view', 'id' => $model->id_categoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
