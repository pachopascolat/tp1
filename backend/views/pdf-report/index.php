<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PdfReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pdf Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pdf-report-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id_pdf_report',
            'timestamp_pdf',
            'nombre_pdf',
            [
                'label'=>'Vidriera',
                'attribute' => 'vidriera_pdf',
                'value'=> 'vidrieraPdf.nombre'
            ],
//            'tela.nombre_tela',
            'userIdPdf.username',
            [
                'label' => 'Editar',
                'format' => 'raw',
                'value' => function ($model) {
//                    $path = trim($model->tela->nombre_tela . "-" . $model->id_pdf_report);
//                    $url = Yii::getAlias("@web/backend/web/../uploads/pdf-report/$path.pdf");
                    return Html::a('Editar', ['update-pdf','id'=>$model->id_pdf_report], ['class' => 'btn btn-warning']);
                }
            ],
            [
                'label' => 'Descargar',
                'format' => 'raw',
                'value' => function ($model) {
//                    $path = trim($model->tela->nombre_tela . "-" . $model->id_pdf_report);
//                    $url = Yii::getAlias("@web/backend/web/../uploads/pdf-report/$path.pdf");
                    return Html::a('Descargar', ['descargar-pdf','id'=>$model->id_pdf_report], ['class' => 'btn btn-success']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
