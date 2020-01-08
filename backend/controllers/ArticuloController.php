<?php

namespace backend\controllers;

use Yii;
use common\models\Articulo;
use common\models\ArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticuloController implements the CRUD actions for Articulo model.
 */
class ArticuloController extends Controller {

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
     * Lists all Articulo models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexPorTela() {
        if (isset($_POST['expandRowKey'])) {
        $searchModel = new ArticuloSearch(['tela_id'=>$_POST['expandRowKey']]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        }else{
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

    /**
     * Displays a single Articulo model.
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
     * Creates a new Articulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Articulo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_articulo]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Articulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_articulo]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Articulo model.
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
     * Finds the Articulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Articulo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionImport($sinCargar = []) {
        ini_set('max_execution_time', 1200);
        $sinCargar = [];
        $model = new ArticuloSearch();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                $model->agotarStock();
                $file = '../stock/' . $model->imageFile->name;
                $data = \moonland\phpexcel\Excel::import($file, []);
                foreach ($data as $row) {
                    $unidades = (int) str_replace([".", ","], "", strval($row['unidades_t']));
                    $codigoTela = trim($row['art_cod']);
                    $nombreTela = trim($row['art_nom']);
                    $codigoColor = trim($row['col_cod']);
                    $nombreColor = trim($row['col_nom']);
//                    $model->tela_id = $codigoTela;
//                    $model->codigo_color = $codigoColor;
                    $rollo = $model->find()->joinWith('tela')->where(['codigo_tela'=>$codigoTela,'codigo_color'=>$codigoColor])->all();
                    foreach ($rollo as $modelo) {
                        $modelo->nombre_color = $nombreColor;
                        if ($unidades > 2) {
                            $modelo->existencia = 1;
                        }
                        $modelo->save();
                    }

//                    if (count($rollo) > 0) {
//                        $stock[] = $rollo;
//                    } else {
//                        $sinCargarModel = new ArticuloSearch();
//                        $sinCargarModel->tela_id = \common\models\Tela::findOne(['codigo_tela' => $codigoTela])->id_tela ?? null;
////                        $sinCargarModel->nombre_tela = $nombreTela;
//                        $sinCargarModel->codigo_color = $codigoColor;
//                        $sinCargarModel->nombre_color = $nombreColor;
//                        $sinCargar[] = $sinCargarModel;
//                    }
                }
//                if (count($sinCargar) > 0) {
//                    $dataProvider = new ArrayDataProvider([
//                        'allModels' => $sinCargar,
//                        'pagination' => [
//                            'pageSize' => false,
//                        ],
//                        'sort' => [
//                            'attributes' => ['codigo_tela', 'name'],
//                        ],
//                    ]);
//                    return $this->render('sinCargar', [
//                                'searchModel' => $sinCargarModel,
//                                'dataProvider' => $dataProvider,
//                    ]);
//                }
            }
        }

        return $this->redirect(['index',
//            'sinCargar'=>$sinCargar
        ]);
    }

}
