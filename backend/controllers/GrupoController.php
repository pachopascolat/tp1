<?php

namespace backend\controllers;

use Yii;
use common\models\Grupo;
use common\models\GrupoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller {

    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'grupo' => Grupo::className()
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
     * Lists all Grupo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
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
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Grupo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_grupo]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Grupo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_grupo]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Grupo model.
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
     * Finds the Grupo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grupo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Grupo::findOne($id)) !== null) {
            return $model;
        }


        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCrearGrupo($tela_id) {
        for ($i = 0; $i < 3; $i++) {
            $newGrupo = new Grupo(['tela_id' => $tela_id]);
            $newGrupo->save();
        }
        $this->redirect(['ver-grupos', 'tela_id' => $tela_id]);
    }

    public function actionBorrarGrupo($id) {
        for ($i = 0; $i < 3; $i++) {
            $grupo = Grupo::findOne($id);
            if ($grupo != null) {
                $grupo->delete();
            }
            $id++;
        }
        $this->redirect(['ver-grupos', 'tela_id' => $grupo->tela_id]);
    }

    public function actionVerGrupos($tela_id) {
        $tela = \common\models\Tela::findOne($tela_id);
//        if ($id_grupo != null) {
//            $grupo = Grupo::findOne($id_grupo);
//            $grupo->load(Yii::$app->request->post());
////            $grupo->nombre = $nombre;
//            $grupo->save();
//        }
//        if ($create) {
//            $newGrupo = new Grupo(['tela_id' => $tela_id]);
//            $newGrupo->save();
//        }
//        if ($delete != null) {
//            $grupo = Grupo::findOne($delete);
//            if ($grupo != null) {
//                $grupo->delete();
//            }
//        }
//        $model = Grupo::findOne(['tela_id'=>$tela_id]);
        return $this->render('verGrupos', ['tela' => $tela]);
    }

}
