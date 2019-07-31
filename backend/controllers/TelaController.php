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
                        'actions' => ['delete-categoria','agregar-categoria','delete-hijo', 'agregar-hijo', 'pasar-categorias', 'index-todos', 'ver-stock', 'borrar-estampados', 'importar-grupos', 'index', 'create', 'view', 'update', 'index-por-categoria', 'delete', 'guardar-fotos', 'comprimir-fotos'],
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

   
    public function actionIndexPorCategoriaOld($categoria_id = 1) {
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

    public function actionIndexTodos() {

        $searchModel = new TelaSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->setPagination(false);
// validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $tela_id = Yii::$app->request->post('editableKey');
            $model = Tela::findOne($tela_id);

            // store a default json response as desired by editable
            $out = \yii\helpers\Json::encode(['output' => '', 'message' => '']);

            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['Tela']);
            $post = ['Tela' => $posted];

            // load model like any single model validation
            if ($model->load($post)) {
                // can save model or do something before saving model
                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                if (isset($posted['ocultar'])) {
                    $output = $model->ocultar ? "SI" : "NO";
                }

                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = \yii\helpers\Json::encode(['output' => $output, 'message' => '']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }


        return $this->render('indexTodos', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
//                    'categoria_padre' => $categoria_padre,
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
        $model->categorys = [];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->categoria_id = $model->categorys[0];
            $model->save();
            foreach ($model->categorys as $newCat) {
                $categoriaTela = new \common\models\CategoriaTela(['tela_id' => $model->id_tela, 'categoria_id' => $newCat]);
                $categoriaTela->save();
            }
            return $this->redirect(['index-todos']);
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
            if ($model->categorys) {
                foreach ($model->categorys as $newCat) {
                    if (!\common\models\CategoriaTela::findOne(['tela_id' => $model->id_tela, 'categoria_id' => $newCat])) {
                        $categoriaTela = new \common\models\CategoriaTela(['tela_id' => $model->id_tela, 'categoria_id' => $newCat]);
                        $categoriaTela->save();
                    }
                }
            }
            return $this->redirect(['index-todos']);
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

        return $this->redirect(['index-todos']);
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

    public function actionPasarCategorias() {
        $telas = Tela::find()->all();
        foreach ($telas as $tela) {
            $catTela = \common\models\CategoriaTela::findOne(['tela_id' => $tela->id_tela]);
            if ($catTela == null) {
                $catTela = new \common\models\CategoriaTela(['tela_id' => $tela->id_tela, 'categoria_id' => $tela->categoria_id, 'orden' => $tela->orden_tela]);
                $catTela->save();
            }
        }
        return $this->redirect(['index-todos']);
    }

    public function actionAgregarHijo($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->tela_hija) {
                $tela_hija = \common\models\TelaAnidada::findOne(['tela_padre' => $model->id_tela, 'tela_hija' => $model->tela_hija]);
                if ($tela_hija == null) {
                    $tela_hija = new \common\models\TelaAnidada(['tela_padre' => $model->id_tela, 'tela_hija' => $model->tela_hija]);
                    $tela_hija->save();
                }
            }
        }
        return $this->goBack();
//        return $this->redirect(['index-todos']);
    }

    public function actionDeleteHijo($id) {
        $model = \common\models\TelaAnidada::findOne($id);
        if ($model) {
            $model->delete();
        }
//        return $this->redirect(['index-todos']);
        return $this->goBack();
    }

    public function actionAgregarCategoria($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->category) {
                $category_tela = \common\models\CategoriaTela::findOne(['tela_id' => $model->id_tela, 'categoria_id' => $model->category]);
                if ($category_tela == null) {
                    $category_tela = new \common\models\CategoriaTela(['tela_id' => $model->id_tela, 'categoria_id' => $model->category]);
                    $category_tela->save();
                }
            }
        }
        return $this->goBack();
    }

    public function actionDeleteCategoria($id) {
        $model = \common\models\CategoriaTela::findOne($id);
        if ($model) {
            $model->delete();
        }
        return $this->goBack();
    }

}
