<?php

namespace backend\controllers;

use Yii;
use common\models\Categoria;
use common\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller {

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
                        'actions' => ['ordenar-categorias','ordenar-categorias-padre','ordenar-vidrieras', 'ordenar', 'index-todos', 'index', 'create', 'view', 'update', 'delete'],
                        'roles' => ['stockManager'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndexTodos() {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexTodos', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
//                    'padre' => 0,
        ]);
    }

    public function actionIndex($categoria_padre = null) {

        $searchModel = new CategoriaSearch([
            'categoria_padre' => $categoria_padre
        ]);
        
        
        

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if($categoria_padre==-1){
            $dataProvider->query->where(['categoria_padre'=>null])->andWhere(['>','id_categoria',2]);
        }
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
//                    'categoria_padre' => $categoria_padre==1? "Hogar" : "Moda"
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $categoria_padre = $model->categoria_padre;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $categoria_padre = $model->categoria_padre;
        $model->delete();

        return $this->redirect(['index', 'categoria_padre' => $categoria_padre]);
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionOrdenar($id) {
        $categoria = Categoria::findOne($id);
        return $this->render('ordenarVidrieras', ['categoria' => $categoria]);
    }
    public function actionOrdenarCategoriasPadre($id) {
        $categoria = Categoria::findOne($id);
        return $this->render('ordenarCategorias', ['categoria' => $categoria]);
    }

    public function actionOrdenarVidrieras() {
        if ($items = Yii::$app->request->post('items')) {
            foreach ($items as $order => $id) {
                $item = \common\models\Vidriera::findOne($id);
                if ($item) {
                    $item->orden_vidriera = $order;
                    $item->save();
                }
            }
        }
    }
    public function actionOrdenarCategorias() {
        if ($items = Yii::$app->request->post('items')) {
            foreach ($items as $order => $id) {
                $item = \common\models\Categoria::findOne($id);
                if ($item) {
                    $item->orden_categoria = $order;
                    $item->save();
                }
            }
        }
    }

}
