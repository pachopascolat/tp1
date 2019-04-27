<?php

namespace backend\controllers;

use Yii;
use common\models\Estampado;
use common\models\EstampadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EstampadoController implements the CRUD actions for Estampado model.
 */
class EstampadoController extends Controller {

    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'estampado' => Estampado::className()
                ]
            ],
        ];
    }

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
        ];
    }

    /**
     * Lists all Estampado models.
     * @return mixed
     */
    public function actionVerDisenios($tela_id) {

        $tela = \common\models\Tela::findOne($tela_id);
        foreach ($tela->estampados as $estampado) {
            foreach ($estampado->getBehavior('galleryBehavior')->getImages() as $image) {
                $models[] = $image;
            }
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $models,
//            'pagination' => [
//                'pageSize' => 20,
//            ]
        ]);
        return $this->render('index', [
                    'searchModel' => $tela,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex() {
        $searchModel = new EstampadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estampado model.
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
     * Creates a new Estampado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tela_id) {
        $model = Estampado::findOne(['tela_id' => $tela_id]);
        if ($model == null) {
            $model = new Estampado(['tela_id' => $tela_id, 'columnas' => 8]);
            $model->save();
            $gallery = $model->importarDeGrupos();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id_estampado]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estampado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ver-estampados', 'tela_id' => $model->tela_id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estampado model.
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
     * Finds the Estampado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estampado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Estampado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionVerEstampados($tela_id) {
        $tela = \common\models\Tela::findOne($tela_id);
        return $this->render('verEstampados', ['tela' => $tela]);
    }

    public function actionCrearEstampado($tela_id) {
//        ini_set('max_execution_time', 600);
//        $tela = \common\models\Tela::findOne($tela_id);
//        $model = Estampado::findOne(['tela_id' => $tela_id]);
//        if ($model == null) {
//            $tela->importarDeGrupos();
//            if (count($tela->estampados) == 0) {
//                $model = new Estampado(['tela_id' => $tela_id]);
//                $model->save();
//            }
//        }
        $model = new Estampado(['tela_id' => $tela_id]);
        $model->save();

//        
////        for ($i = 0; $i < 3; $i++) {
//            $newGrupo = new Estampado(['tela_id' => $tela_id,'columnas'=>8]);
//            $newGrupo->save();
////        }
        $this->redirect(['update-estampados', 'tela_id' => $tela_id]);
    }

    public function actionBorrarEstampado($id) {
//        for ($i = 0; $i < 3; $i++) {
        $grupo = Estampado::findOne($id);
        $tela_id = $grupo->tela_id;
        if ($grupo != null) {
//            $grupo->deleteImages();
            $grupo->delete();
        }
//            $id++;
//        }
        $this->redirect(['update-estampados', 'tela_id' => $tela_id]);
    }

    public function actionUpdateEstampados($tela_id) {
        $tela = \common\models\Tela::findOne($tela_id);
        $settings = Estampado::find()->where(['tela_id' => $tela_id])->orderBy('orden')->all();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->setColumnas();
                $setting->save(false);
            }
//            return $this->redirect('ud');
        }

        return $this->render('verEstampados', [
            'settings' => $settings, 
            'tela_id' => $tela_id, 
            'tela' => $tela]);
    }

}
