<?php

namespace backend\controllers;

use Yii;
use common\models\Galeria;
use common\models\GaleriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use zxbodya\yii2\galleryManager\GalleryManagerAction;
use yii\base\Model;

/**
 * GaleriaController implements the CRUD actions for Galeria model.
 */
class GaleriaController extends Controller {

    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'galeria' => Galeria::className()
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

    public function actionCrearGaleria($tela_id, $tipo = Galeria::DISENIO) {
        $model = new Galeria(['tela_id' => $tela_id, 'tipo_galeria' => $tipo]);
        $model->save();
        $this->redirect(['update-galerias', 'tela_id' => $tela_id, 'tipo' => $tipo]);
    }

    public function actionBorrarGaleria($id) {
//        for ($i = 0; $i < 3; $i++) {
        $grupo = Galeria::findOne($id);
        $tela_id = $grupo->tela_id;
        if ($grupo != null) {
//            $grupo->deleteImages();
            $grupo->delete();
        }
//            $id++;
//        }
        $this->redirect(['update-galerias', 'tela_id' => $tela_id]);
    }

    public function actionUpdateGalerias($tela_id, $tipo = Galeria::DISENIO) {
        $tela = \common\models\Tela::findOne($tela_id);
        $settings = Galeria::find()->where(['tela_id' => $tela_id, 'tipo_galeria' => $tipo])->orderBy('orden')->all();

        if (Model::loadMultiple($settings, Yii::$app->request->post()) && Model::validateMultiple($settings)) {
            foreach ($settings as $setting) {
                $setting->setColumnas();
                $setting->save(false);
            }
//            return $this->redirect('ud');
        }

        return $this->render('verGalerias', [
                    'settings' => $settings,
                    'tela_id' => $tela_id,
                    'tipo' => $tipo,
                    'tela' => $tela
        ]);
    }

    /**
     * Lists all Galeria models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GaleriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Galeria model.
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
     * Creates a new Galeria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Galeria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_galeria]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Galeria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_galeria]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Galeria model.
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
     * Finds the Galeria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Galeria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Galeria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVerDisenios($tela_id) {

        $searchModel = new \common\models\GalleryImageSearch([
            'tela_id' => $tela_id,
            'tipo_galeria' => Galeria::DISENIO,
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);






        $tela = \common\models\Tela::findOne($tela_id);
//        foreach ($tela->disenios as $estampado) {
//            foreach ($estampado->getBehavior('galleryBehavior')->getImages() as $image) {
//                $models[] = $image;
//            }
//        }
//
//        $dataProvider = new \yii\data\ArrayDataProvider([
//            'allModels' => $models,
////            'pagination' => [
////                'pageSize' => 20,
////            ]
//        ]);
        return $this->render('index', [
                    'tela' => $tela,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

//    function actionLlenarGalerias() {
//        $lisos = \common\models\Lisos::find()->all();
//        foreach ($lisos as $modelo) {
//            $galeria = Galeria::findOne(['tela_id' => $modelo->tela_id,'tipo_galeria' => Galeria::LISO]);
//            if ($galeria == null) {
//                $galeria = new Galeria(['tela_id' => $modelo->tela_id, 'tipo_galeria' => Galeria::LISO]);
//                $galeria->save();
//            }
//            $imagenes = $modelo->getBehavior('galleryBehavior')->getImages();
//            foreach ($imagenes as $image) {
//                $origen = dirname($modelo->getFilePath($image->id));
//                $destino = $galeria->getBehavior('galleryBehavior')->directory;
//                $destino .= "/$galeria->id_galeria/$image->id/";
//                $this->recursive_copy($origen, $destino);
//
//                $activeImage = \common\models\GalleryImage::findOne($image->id);
//                $activeImage->type = 'galeria';
//                $activeImage->ownerId = "$galeria->id_galeria";
//                $activeImage->save();
//            }
//        }
//
////        $modelos = \common\models\Modelo::find()->all();
////        foreach ($modelos as $modelo) {
////            $galeria = Galeria::findOne(['color_id' => $modelo->disenio_id]);
////            if ($galeria == null) {
////                $galeria = new Galeria(['tela_id' => $modelo->disenio->getTela()->id_tela, 'tipo_galeria' => Galeria::MODEL0, 'color_id' => $modelo->disenio_id]);
////                $galeria->save();
////            }
////            $imagenes = $modelo->getBehavior('galleryBehavior')->getImages();
////            foreach ($imagenes as $image) {
////                $url = $image->getUrl('original');
////                $origen = dirname($modelo->getFilePath($image->id));
////                $destino = $galeria->getBehavior('galleryBehavior')->directory;
////                $destino .= "/$galeria->id_galeria/$image->id/";
////                $this->recursive_copy($origen, $destino);
//////                exec("cp -r $origen $destino");
////
////                $activeImage = \common\models\GalleryImage::findOne($image->id);
////                $activeImage->type = 'galeria';
////                $activeImage->ownerId = "$galeria->id_galeria";
////                $activeImage->save();
////                $foo = 1;
////            }
////        }
//        return $this->redirect(['index']);
//    }

    function recursive_copy($src, $dst) {
        $dir = opendir($src);
        FileHelper::createDirectory(FileHelper::normalizePath($dst), 0777);
        while (( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    $this->recursive_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}
