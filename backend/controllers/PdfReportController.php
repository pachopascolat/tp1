<?php

namespace backend\controllers;

use Yii;
use common\models\PdfReport;
use common\models\PdfReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mikehaertl\wkhtmlto\Pdf as Pdf2;
use common\models\GalleryImageSearch;
use common\models\GalleryImage;
use yii\filters\AccessControl;

/**
 * PdfReportController implements the CRUD actions for PdfReport model.
 */
class PdfReportController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
//                        'allow' => \Yii::$app->user->getId() == 2,
                        'allow' => true,
                        'actions' => ['descargar-pdf', 'ordenar-disenios', 'export-pdf', 'export-index', 'toggle-estado', 'import-diferencias', 'import', 'ver-stock', 'exportar', 'photo-grid', 'report', 'index', 'create', 'view', 'update', 'delete', 'toggle-oferta', 'toggle-agotado', 'index-by-tela'],
                        'roles' => ['stockManager','ventasManager'],
                    ],
                ],
            ],
        ];
    }

    public function actionPhotoGrid() {
//        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->pagination = FALSE;
//        $data = [];
        if ($estampados = \Yii::$app->request->post("estampados")) {
            foreach ($estampados as $id) {

                $data[] = $id;
            }
            $this->redirect(['report', 'ids' => json_encode($data)]);
        }

//        return $this->render('_photoGrid', ['data' => $dataProvider->getModels(),'tela_id'=>$tela_id]);
    }

    public function actionExportIndex($tela_id = -1) {
        $model = new PdfReport();
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->searchVisibles(Yii::$app->request->queryParams);
        if ($searchModel->load(\Yii::$app->request->post())) {
            $model->tela_id = $searchModel->tela_id;
            $dataProvider = $searchModel->searchVisibles(Yii::$app->request->queryParams);
        }
        $dataProvider->setPagination(FALSE);
        $data = $dataProvider->getModels();
        return $this->render('exportIndex', ['data' => $data,
//            'telas'=>$telas,
                    'model' => $model,
                    'searchModel' => $searchModel]);
    }

    public function actionExportPdf($tela_id = -1) {
        $model = new PdfReport();
        $data = [];
//        $telas = [];
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->searchVisibles(Yii::$app->request->queryParams);

        if ($searchModel->load(\Yii::$app->request->post())) {
            $model->tela_id = $searchModel->tela_id;
            $dataProvider = $searchModel->searchVisibles(Yii::$app->request->queryParams);
        }
        if ($estampados = \Yii::$app->request->post("estampados")) {
            $this->report($estampados);
        }

        $dataProvider->setPagination(FALSE);
        $data = $dataProvider->getModels();
        return $this->render('exportIndex', ['data' => $data,
//            'telas'=>$telas,
                    'model' => $model,
                    'searchModel' => $searchModel]);
    }

    public function report($estampados) {
        foreach ($estampados as $id) {
            $alldata[] = GalleryImage::findOne($id);
        }
        $options = [
            'binary' => Yii::getAlias("@vendor/wkhtmltopdf"),
            'page-size' => 'A4',
//            'header-html' => $this->renderPartial('_pdfHeader'),
//            'footer-html' => $this->renderPartial('_pdfFooter'),
            'no-outline', // option without argument
            'encoding' => 'UTF-8', // option with argument
//            'user-style-sheet' => $cssPath,
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'disable-smart-shrinking',
            'user-style-sheet' => Yii::getAlias("@backend/web/css/pdfstyle.css"),
//            'header-html' => "<h1>Texsim</h1>",
        ];

//        $pdf = new Pdf2(\Yii::getAlias("@backend/views/gallery-image/_report.php"));
        $model = new PdfReport(['user_id_pdf' => Yii::$app->user->getId()]);
        if ($model->load(Yii::$app->request->post())) {
            $model->header = \yii\web\UploadedFile::getInstance($model, 'header');
            $model->header2 = \yii\web\UploadedFile::getInstance($model, 'header2');
            if ($model->header) {
                $model->uploadHeader();
            }
            if ($model->header2) {
                $model->uploadHeader2();
            }
        }
        $pdf = new Pdf2($options);
        if ($model->header) {
            $pages = array_chunk($alldata, 12);
            $pdf->addPage($this->renderPartial('_reportPrimera', ['data' => $pages[0], 'nro' => 1, 'header' => $model->getHeaderName(1)]));
            $alldata = array_slice($alldata, 12);
        }
        $pages = array_chunk($alldata, 16);
        foreach ($pages as $nro => $page) {
            $pdf->addPage($this->renderPartial('_report', ['data' => $page, 'nro' => $nro, 'header2' => $model->getHeaderName(2)]));
        }
//        return $this->renderPartial('_report', ['data' => $pages[0]]);

        if (!$model->nombre_pdf) {
            $date = date("Y-m-d-H-m-i");
            $model->nombre_pdf = trim($model->tela->nombre_tela . "-" . $date);
        }
        if ($model->guardar && $model->save()) {
            $pdf->saveAs(Yii::getAlias("@backend/uploads/pdf-report/" . $model->id_pdf_report . ".pdf"));
        }
        $timestamp = date("Y-m-d-H-m-i");
        if (!$pdf->send("$model->nombre_pdf.pdf")) {
            throw new \Exception('Could not create PDF: ' . $pdf->getError());
        }

        return true;
    }

    /**
     * Lists all PdfReport models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PdfReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PdfReport model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PdfReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PdfReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pdf_report]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing PdfReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pdf_report]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PdfReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PdfReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PdfReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PdfReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDescargarPdf($id) {
        $pdf = PdfReport::findOne($id);
        if ($pdf) {
            $path = Yii::getAlias('@backend') . '/uploads/pdf-report';
            $file = $path . "/$pdf->id_pdf_report.pdf";
            if (file_exists($file)) {
                return Yii::$app->response->sendFile($file, $pdf->nombre_pdf.".pdf");
            }
        }
    }

}
