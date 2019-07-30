<?php

namespace backend\controllers;

use Yii;
use common\models\CategoriaTela;
use common\models\CategoriaTelaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaTelaController implements the CRUD actions for CategoriaTela model.
 */
class CategoriaTelaController extends Controller {

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
     * Lists all CategoriaTela models.
     * @return mixed
     */
    public function actionIndexPorCategoria($categoria_id = 1) {
        $categoria_padre = \common\models\Categoria::findOne($categoria_id)->categoria_padre;
        if ($categoria_padre == null) {
            $categoria_padre = 1;
        }
        $searchModel = new \common\models\CategoriaTelaSearch();
//        $searchModel->categoria_padre = $categoria_padre;
        $searchModel->categoria_id = $categoria_id;
//        $searchModel = new TelaSearch(['categoria_padre' => $categoria_padre,'categoria_id'=>$categoria_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexPorCategoria', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'categoria_padre' => $categoria_padre,
        ]);
    }

    public function actionIndex() {
        $searchModel = new CategoriaTelaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-todos', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriaTela model.
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
     * Creates a new CategoriaTela model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CategoriaTela();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_categoria_tela]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoriaTela model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_categoria_tela]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoriaTela model.
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
     * Finds the CategoriaTela model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoriaTela the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CategoriaTela::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
