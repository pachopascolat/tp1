<?php

namespace backend\controllers;

use Yii;
use common\models\Articulo;
use common\models\ArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
//                        'allow' => \Yii::$app->user->getId() == 2,
                        'allow' => true,
//                        'actions' => ['*'],
                        'roles' => ['stockManager'],
                    ],
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
            $searchModel = new ArticuloSearch(['tela_id' => $_POST['expandRowKey']]);
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->renderPartial('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
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
            return $this->redirect(['index', 'ArticuloSearch[nombre_color]' => $model->nombre_color]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }
    public function actionUpdateImage($id) {
        $model = $this->findModel($id);

        if ($image = Yii::$app->request->post("imagen$model->id_articulo")){
            $model->imagen_id = $image;
            $model->save(); 
            return $this->redirect(['index', 'ArticuloSearch[nombre_color]' => $model->nombre_color]);
        }

//        return $this->render('update', [
//                    'model' => $model,
//        ]);
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

//                    if ($unidades > 2) {
                    $tela = \common\models\Tela::findOne(['codigo_tela' => $codigoTela]);
                    if (!$tela) {
                        $tela = new \common\models\Tela(['codigo_tela' => $codigoTela, 'nombre_tela' => $nombreTela]);
                        $tela->save();
                    }
//                    }
//                    $model->tela_id = $codigoTela;
//                    $model->codigo_color = $codigoColor;
                    $articulo = $model->find()->joinWith('tela')->where(['codigo_tela' => $codigoTela, 'codigo_color' => $codigoColor])->all();
                    if (count($articulo) > 0) {
                        foreach ($articulo as $modelo) {
                            $modelo->nombre_color = $nombreColor;
                            if ($unidades > 2) {
                                $modelo->existencia = 1;
                            }
                            $modelo->save();
                        }
                    } else {
                        $articulo = new Articulo(['codigo_color' => $codigoColor, 'nombre_color' => $nombreColor, 'tela_id' => $tela->id_tela]);
                        $articulo->save();
                    }
                }
            }
        }
        return $this->redirect(['index',
//            'sinCargar'=>$sinCargar
        ]);
    }

    public function actionMigrarImagenesViejas() {
        set_time_limit(12000);
        $articulos = Articulo::find()->all();
        foreach ($articulos as $articulo) {
            foreach ($articulo->getOldImage() as $galleryImage) {
                $articulo->migrarImagen($galleryImage);
            }
        }
        return $this->redirect(['index']);
    }

}
