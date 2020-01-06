<?php

namespace backend\controllers;

use Yii;
use common\models\Vidriera;
use common\models\VidrieraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VidrieraController implements the CRUD actions for Vidriera model.
 */
class VidrieraController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Vidriera models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new VidrieraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vidriera model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $providerItemVidirera = new \yii\data\ArrayDataProvider([
            'allModels' => $model->itemVidireras,
        ]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'providerItemVidirera' => $providerItemVidirera,
        ]);
    }

    /**
     * Creates a new Vidriera model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Vidriera();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['ordenar-vidriera','id'=>$model->id_vidriera]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vidriera model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id_vidriera]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vidriera model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vidriera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vidriera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Vidriera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for ItemVidirera
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddItemVidirera() {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ItemVidirera');
            if (!empty($row)) {
                $row = array_values($row);
            }
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formItemVidirera', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFiltrarArticulos() {
        $articuloSearch = new \common\models\ArticuloSearch();
        $dataprovider = $articuloSearch->search(Yii::$app->request->queryParams);
        return $this->renderAjax('_modal_nuevo_item', [
//            'vidriera' => $vidriera,
                    'dataProvider' => $dataprovider,
//            'dataProvider2' => $dataprovider2,
                    'articuloSearch' => $articuloSearch,
//            'imagenSearch' => $imagenSearch
        ]);
    }

    public function actionFiltrarImagenes() {
        $articuloSearch = new \common\models\ArticuloSearch();
        $imagenSearch = new \noam148\imagemanager\models\ImageManagerSearch();
        $dataprovider = $imagenSearch->search(Yii::$app->request->queryParams);
        return $this->renderAjax('_modal_imagenes_galeria', [
//            'vidriera' => $vidriera,
//            'dataProvider' => $dataprovider,
                    'dataProvider2' => $dataprovider,
                    'articuloSearch' => $articuloSearch,
                    'imagenSearch' => $imagenSearch
        ]);
    }

    public function actionOrdenarVidriera($id) {
        $vidriera = Vidriera::findOne($id);
        $articuloSearch = new \common\models\ArticuloSearch();
        $imagenSearch = new \noam148\imagemanager\models\ImageManagerSearch();
        $dataprovider = $articuloSearch->search(Yii::$app->request->queryParams);
        $dataprovider2 = $imagenSearch->search(Yii::$app->request->queryParams);
        $dataprovider->getPagination()->setPageSize(100);
//        if ($ids = Yii::$app->request->post('selectedItem')) {
//            if ($ids) {
//                $vidriera->addItems($ids);
//                return $this->redirect(['ordenar-vidriera', 'id' => $vidriera->id_vidriera]);
//            }
//        }
        return $this->render('ordenarVidriera', [
                    'vidriera' => $vidriera,
                    'dataProvider' => $dataprovider,
                    'dataProvider2' => $dataprovider2,
                    'articuloSearch' => $articuloSearch,
                    'imagenSearch' => $imagenSearch
        ]);
    }

    public function actionDeleteItem($id) {
        $item = \common\models\ItemVidirera::findOne($id);
        $vidriera = $item->vidriera ?? null;
        if ($item) {
            $item->delete();
        }
        return $this->renderAjax('_items_vidriera', [
                    'vidriera' => $vidriera,
        ]);
    }

    public function actionAgregarItems($id) {
        if (\Yii::$app->request->isAjax) {
            $vidriera = Vidriera::findOne($id);
            if ($items = Yii::$app->request->post('selectedItem')) {
                if ($items) {
                    $vidriera->addItems($items);
//                return $this->redirect(['ordenar-vidriera', 'id' => $vidriera->id_vidriera]);
                }
            }
            return $this->renderAjax('_items_vidriera', [
                        'vidriera' => $vidriera,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCambiarImagen($id) {
//        $model = new \common\models\ItemVidirera();
        $data = Yii::$app->request->post();
        $model = \common\models\ItemVidirera::findOne($id);
        $vidriera = $model->vidriera ?? null;
        if ($model) {
            $model->imagen_id = $data['imagenId'];
            $model->save();
        }
        return $this->renderAjax('_items_vidriera', [
                    'vidriera' => $vidriera,
        ]);
    }

    public function actionOrdenarItems() {
        if ($items = Yii::$app->request->post('items')) {
            foreach ($items as $order => $id) {
                $item = \common\models\ItemVidirera::findOne($id);
                if ($item) {
                    $item->orden_item_vidriera = $order;
                    $item->save();
                }
            }
        }
//        return $this->renderAjax('_items_vidriera', [
//                    'vidriera' => $vidriera,
//        ]);
    }

}
