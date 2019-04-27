<?php

namespace backend\controllers;

use Yii;
use common\models\Tela;
use common\models\TelaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use yii\filters\AccessControl;

/**
 * TelaController implements the CRUD actions for Tela model.
 */
class TelaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'tela' => Tela::className()
                ]
            ],
        ];
    }

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
                        'allow' => true,
                        'actions' => ['borrar-estampados', 'importar-grupos', 'index', 'create', 'view', 'update', 'index-por-categoria', 'delete', 'guardar-fotos', 'comprimir-fotos'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tela models
     * @return mixed
     */
    public function actionIndex($categoria_padre = 1) {
        $searchModel = new TelaSearch();
        $searchModel->categoria_padre = $categoria_padre;
//        $searchModel->categoria_id = $categoria_id;
//        $searchModel = new TelaSearch(['categoria_padre' => $categoria_padre,'categoria_id'=>$categoria_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'categoria_padre' => $categoria_padre,
        ]);
    }

    public function actionIndexPorCategoria($categoria_id) {
        $categoria_padre = \common\models\Categoria::findOne($categoria_id)->categoria_padre;
        if ($categoria_padre == null) {
            $categoria_padre = 1;
        }
        $searchModel = new TelaSearch();
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

    /**
     * Displays a single Tela model.
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
     * Creates a new Tela model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($categoria_padre = null, $categoria_id = null) {
        $model = new Tela(['categoria_id' => $categoria_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-por-categoria', 'categoria_id' => $categoria_id]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'categoria_padre' => $categoria_padre,
        ]);
    }

    /**
     * Updates an existing Tela model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $categoria_padre = $model->categoria->categoria_padre;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-por-categoria', 'categoria_id' => $model->categoria_id]);
        }


        return $this->render('update', [
                    'model' => $model,
                    'categoria_padre' => $categoria_padre,
        ]);
    }

    /**
     * Deletes an existing Tela model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $categoria_id = $model->categoria_id;
        $model->delete();

        return $this->redirect(['index-por-categoria', 'categoria_id' => $categoria_id]);
    }

    /**
     * Finds the Tela model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tela the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tela::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    function actionGuardarFotos() {
        $telas = Tela::find()->all();
//        $lisos = \common\models\Lisos::find()->all();
//        $discontinuos = \common\models\Discontinuos::find()->all();
        foreach ($telas as $tela) {
            $disenios = $tela->getBehavior('galleryBehavior')->getImages();
            $lisos = $tela->lisos->getBehavior('galleryBehavior')->getImages();
            $discontinuos = $tela->discontinuos->getBehavior('galleryBehavior')->getImages();
            foreach ($disenios as $dis) {
                $folderPath = Yii::getAlias('@backend') . "/web/images/tela/gallery/" . $tela->getNombreCompleto() . "/";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath);
                }
                $source = Yii::getAlias('@backend') . "/web/images/tela/gallery/$tela->id_tela/$dis->id/original.jpg";
                $destiny = Yii::getAlias('@backend') . "/web/images/tela/gallery/" . $tela->getNombreCompleto() . "/$dis->id.jpg";
                if (file_exists($source) && !file_exists($destiny)) {
                    copy($source, $destiny);
                }
            }
            foreach ($discontinuos as $discontinuo) {
                $folderPath = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->getNombreCompleto() . "/";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath);
                }
                $source = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->discontinuos->id_discontinuos . "/$discontinuo->id/original.jpg";
                $destiny = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->getNombreCompleto() . "/$discontinuo->id.jpg";
                if (file_exists($source) && !file_exists($destiny)) {
                    copy($source, $destiny);
                }
            }
            foreach ($lisos as $liso) {
                $folderPath = Yii::getAlias('@backend') . "/web/images/lisos/gallery/" . $tela->getNombreCompleto() . "/";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath);
                }
                $source = Yii::getAlias('@backend') . "/web/images/lisos/gallery/" . $tela->lisos->id_lisos . "/$liso->id/original.jpg";
                $destiny = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->getNombreCompleto() . "/$liso->id.jpg";
                if (file_exists($source) && !file_exists($destiny)) {
                    copy($source, $destiny);
                }
            }
        }
    }

    function actionComprimirFotos() {
        $telas = Tela::find()->all();
//        $lisos = \common\models\Lisos::find()->all();
//        $discontinuos = \common\models\Discontinuos::find()->all();
        foreach ($telas as $tela) {
            $disenios = $tela->getBehavior('galleryBehavior')->getImages();
            $lisos = $tela->lisos->getBehavior('galleryBehavior')->getImages();
            $discontinuos = $tela->discontinuos->getBehavior('galleryBehavior')->getImages();
            foreach ($disenios as $dis) {
//                $folderPath = Yii::getAlias('@backend') . "/web/images/tela/gallery/" . $tela->getNombreCompleto() . "/";
//                if (!file_exists($folderPath)) {
//                    mkdir($folderPath);
//                }
                $source = Yii::getAlias('@backend') . "/web/images/tela/gallery/$tela->id_tela/$dis->id/medium.jpg";
                $source2 = Yii::getAlias('@backend') . "/web/images/tela/gallery/$tela->id_tela/$dis->id/preview.jpg";
//                $destiny = Yii::getAlias('@backend') . "/web/images/tela/gallery/" . $tela->getNombreCompleto() . "/$dis->id.jpg";
                if (!file_exists($source . "-c") && !file_exists($source2 . "-c")) {
                    \yii\imagine\Image::getImagine()->open($source)->save($source . "-c", ['quality' => 70]);
                    \yii\imagine\Image::getImagine()->open($source2)->save($source2 . "-c", ['quality' => 70]);
                }
            }
            foreach ($discontinuos as $discontinuo) {
//                $folderPath = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/". $tela->getNombreCompleto() . "/";
//                if (!file_exists($folderPath)) {
//                    mkdir($folderPath);
//                }
                $source = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->discontinuos->id_discontinuos . "/$discontinuo->id/medium.jpg";
                $source = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->discontinuos->id_discontinuos . "/$discontinuo->id/preview.jpg";
//                $destiny = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->getNombreCompleto() . "/$discontinuo->id.jpg";
                if (!file_exists($source . "-c") && !file_exists($source2 . "-c")) {
                    \yii\imagine\Image::getImagine()->open($source)->save($source . "-c", ['quality' => 70]);
                    \yii\imagine\Image::getImagine()->open($source2)->save($source2 . "-c", ['quality' => 70]);
                }
            }
            foreach ($lisos as $liso) {
                $folderPath = Yii::getAlias('@backend') . "/web/images/lisos/gallery/" . $tela->getNombreCompleto() . "/";
                if (!file_exists($folderPath)) {
                    mkdir($folderPath);
                }

                $source = Yii::getAlias('@backend') . "/web/images/lisos/gallery/" . $tela->lisos->id_lisos . "/$liso->id/medium.jpg";
                $source = Yii::getAlias('@backend') . "/web/images/lisos/gallery/" . $tela->lisos->id_lisos . "/$liso->id/preview.jpg";
//                $destiny = Yii::getAlias('@backend') . "/web/images/discontinuos/gallery/" . $tela->getNombreCompleto() . "/$liso->id.jpg";
                if (!file_exists($source . "-c") && !file_exists($source2 . "-c")) {
                    \yii\imagine\Image::getImagine()->open($source)->save($source . "-c", ['quality' => 70]);
                    \yii\imagine\Image::getImagine()->open($source2)->save($source2 . "-c", ['quality' => 70]);
                }
            }
        }
    }

    public function actionImportarGrupos() {

        ini_set('max_execution_time', 600);
        $telas = Tela::find()->all();
        foreach ($telas as $tela) {
            $tela->importarDeGrupos();
        }
        return $this->redirect(['/categoria/index', 'categoria_padre' => 1]);
    }

    public function actionBorrarEstampados() {
        ini_set('max_execution_time', 600);
        $telas = Tela::find()->all();
        foreach ($telas as $tela) {
            foreach ($tela->estampados as $estampado) {
                $estampado->delete();
            }
        }
        return $this->redirect(['/categoria/index', 'categoria_padre' => 1]);
    }

}
