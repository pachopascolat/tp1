<?php

namespace backend\controllers;

use Yii;
use common\models\GalleryImage;
use common\models\GalleryImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
                        'actions' => ['index', 'create', 'view', 'update', 'delete','toggle-oferta','toggle-agotado','index-by-tela'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
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
        $searchModel = new GalleryImageSearch(['tela_id'=>$tela_id]);
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
