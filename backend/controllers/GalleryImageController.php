<?php

namespace backend\controllers;

use Yii;
use common\models\GalleryImage;
use common\models\GalleryImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use ZipArchive;
use mikehaertl\wkhtmlto\Pdf as Pdf2;
use yii\web\UploadedFile;
use moonland\phpexcel;

/**
 * GalleryImageController implements the CRUD actions for GalleryImage model.
 */
class GalleryImageController extends Controller {

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
                        'allow' => \Yii::$app->user->getId() == 2,
                        'actions' => ['import', 'ver-stock', 'exportar', 'photo-grid', 'report', 'index', 'create', 'view', 'update', 'delete', 'toggle-oferta', 'toggle-agotado', 'index-by-tela'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionPhotoGrid($tela_id) {
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

    public function actionExportar($tela_id) {
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id, 'agotado' => 0]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = FALSE;
        $data = [];

        if ($estampados = \Yii::$app->request->post("estampados")) {
            $zip = new ZipArchive();
            $file = tempnam(sys_get_temp_dir(), 'Texsim') . ".zip";
            if ($zip->open($file, ZipArchive::CREATE) !== TRUE) {
                throw new \Exception('Cannot create a zip file');
            }
            foreach ($estampados as $id) {
                $estampado = GalleryImage::findOne($id);
                $path = $estampado->getPath("original");
                $zip->addFile($path, "{$estampado->getNombreTela()}-codigo:$estampado->name.jpg");
            }
            $zip->close();
            return \Yii::$app->response->sendFile($file);
//            return $file;
//            $this->redirect(['report', 'ids' => json_encode($data)]);
        }

        return $this->render('_photoGrid', ['data' => $dataProvider->getModels(), 'tela_id' => $tela_id]);
    }

    public function actionReport($ids) {
        $alldata = [];
        $ids = json_decode($ids);
        foreach ($ids as $id) {
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
        $pdf = new Pdf2($options);
        $pages = array_chunk($alldata, 30);

        foreach ($pages as $nro => $page) {
            $pdf->addPage($this->renderPartial('_report', ['data' => $page, 'nro' => $nro]));
        }
//        return $this->renderPartial('_report', ['data' => $pages[0]]);

        if (!$pdf->send('report.pdf')) {
            throw new \Exception('Could not create PDF: ' . $pdf->getError());
        }

        return true;

//        return $this->render('_report',['data'=>$alldata]);
        $content = $this->renderPartial('_report', ['data' => $alldata]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Telas'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['TEXSIM     Lavalle 2571, C1052AAE CABA, Argentina      TEL: (54 11) 2120-0550'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionReportAll($tela_id) {
//        $searchModel = new GalleryImageSearch();
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = FALSE;
        // get your HTML raw content without any layouts or scripts
//        return $this->renderPartial('_report',['data'=>$dataProvider->getModels()]);
        $content = $this->renderPartial('_report', ['data' => $dataProvider->getModels()]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Telas'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => ['TEXSIM     Lavalle 2571, C1052AAE CABA, Argentina      TEL: (54 11) 2120-0550'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Lists all GalleryImage models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GalleryImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexByTela($tela_id) {
//        $searchModel = new GalleryImageSearch();
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVerStock($tela_id = null,$sinCargar = []) {
        $searchModel = new \common\models\GalleryImageSearch([
            'tela_id' => $tela_id,
            'type' => 'galeria']);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('todos_disenios', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'sinCargar' => $sinCargar,
//                    'categoria_padre' => $categoria_padre,
        ]);
    }

    public function actionImport($sinCargar = []) {
        $model = new GalleryImageSearch();
        if (Yii::$app->request->isPost) {
            
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $model->agotarStock();
                $file = '../stock/' . $model->imageFile->name;
                $data = \moonland\phpexcel\Excel::import($file, []);
                foreach ($data as $row){
//                    foreach ($row as  $col){
                        $codigoTela = trim($row['art_cod']);
                        $nombreTela = trim($row['art_nom']);
                        $codigoColor = trim($row['col_cod']);
                        $nombreColor = trim($row['col_nom']);
                        $model->codigo_tela = $codigoTela;
                        $model->name = $codigoColor;
                        $rollo = $model->search(null)->getModels();
                        foreach ($rollo as $modelo){
                            $modelo->agotado = 0;
                            $modelo->description = $nombreColor;
                            $modelo->save();
                        }
//                    }
                        if(count($rollo)>0){
                            $stock[] = $rollo;
                        }else{
                            $sinCargarModel = new GalleryImageSearch();
                            $sinCargarModel->codigo_tela = $codigoTela;
                            $sinCargarModel->nombre_tela = $nombreTela;
                            $sinCargarModel->name = $codigoColor;
                            $sinCargarModel->description = $nombreColor;
                            $sinCargar[] = $sinCargarModel;
                            
                        }
                }   
            }
        }

        return $this->redirect(['ver-stock','sinCargar'=>$sinCargar]);
    }

    /**
     * Displays a single GalleryImage model.
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
     * Creates a new GalleryImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new GalleryImage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing GalleryImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GalleryImage model.
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
     * Finds the GalleryImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GalleryImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = GalleryImage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionToggleAgotado() {
        $id = Yii::$app->request->get('id');
        $model = GalleryImage::findOne($id);
        if ($model != null) {
            $model->agotado = !$model->agotado;
            $model->save();
        }
//        $this->redirect(['index']);
    }

    public function actionToggleOferta() {
        $id = Yii::$app->request->get('id');
        $model = GalleryImage::findOne($id);
        if ($model != null) {
            $model->oferta = !$model->oferta;
            $model->save();
        }
//        $this->redirect(['index']);
    }

}
