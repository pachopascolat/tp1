<div class="modal fade" id="pdf-report-modal" >
    <div class="modal-dialog" role="document">
        <?php $form = yii\widgets\ActiveForm::begin(['action'=> \yii\helpers\Url::to(['/sitio/descargar-pdf'])]) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Descarga tu Catalogo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $pdfs = \common\models\PdfReport::find()->orderBy('nombre_pdf')->all();
                $items = yii\helpers\ArrayHelper::map($pdfs, 'id_pdf_report', 'nombre_pdf');
//                echo yii\helpers\Html::dropDownList('pdf-report-id', null, $items,['prompt' => 'Elegí un catalogo para descargar','class'=>'form-control','id'=>'pdf-report-id']);
                echo $form->field(new \common\models\PdfReport(), 'id_pdf_report')->dropDownList($items, ['prompt' => 'Elegí un catalogo para descargar'])->label(false);
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary descargar-pdf-btn">Descargar PDF</button>
            </div>
        </div>
        <?php yii\widgets\ActiveForm::end() ?>

    </div>
</div>