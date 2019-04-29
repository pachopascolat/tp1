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
                        'actions' => ['photo-grid','report','index', 'create', 'view', 'update', 'delete', 'toggle-oferta', 'toggle-agotado', 'index-by-tela'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionPhotoGrid($tela_id){
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = FALSE;
        $data = [];
        if($estampados = \Yii::$app->request->post("estampados")){
            foreach ($estampados as $id){
                
                $data[] = $id;
            }
            $this->redirect(['report','ids'=> json_encode($data)]);
        }

        return $this->render('_photoGrid',['data'=>$dataProvider->getModels()]);
    }
    
    
    
    public function actionReport($ids) {
        $alldata = [];
        $ids = json_decode($ids);
        foreach ($ids as $id){
            $alldata[] = GalleryImage::findOne($id);
        }
//        $searchModel = new GalleryImageSearch();
//        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->pagination = FALSE;
        // get your HTML raw content without any layouts or scripts
//        return $this->render('_report',['data'=>$alldata]);
        $content = $this->renderPartial('_report',['data'=>$alldata]);

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
    public function actionReportAll($tela_id) {
//        $searchModel = new GalleryImageSearch();
        $searchModel = new GalleryImageSearch(['tela_id' => $tela_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = FALSE;
        // get your HTML raw content without any layouts or scripts
//        return $this->renderPartial('_report',['data'=>$dataProvider->getModels()]);
        $content = $this->renderPartial('_report',['data'=>$dataProvider->getModels()]);

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
