<?php

namespace frontend\controllers;

use Yii;

class SitioController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new \common\models\VidrieraSearch(['categoria_id' => 22]);
        $dataProvider = $searchModel->search(null);
        $dataProvider->getPagination()->setPageSize(7);
//        $telas = \common\models\Vidriera::find()->where(['categoria_id' => 22])->orderBy('orden_vidriera')->all();
        return $this->render('porCategoria', ['dataProvider' => $dataProvider]);
//        return $this->render('index');
//        return $this->redirect(['por-categoria', 'id_categoria' => 22]);
    }

    public function actionCategoriaPadre($valor) {
        $_SESSION['categoria_padre'] = $valor;
        return $this->redirect(['index']);
    }

    public function actionHogar() {
        $_SESSION['categoria_padre'] = 1;
        return $this->redirect(['por-categoria', 'id_categoria' => $_SESSION['categoria_padre']]);
    }

    public function actionModa() {
        $_SESSION['categoria_padre'] = 2;
        return $this->redirect(['por-categoria', 'id_categoria' => $_SESSION['categoria_padre']]);
    }

    public function actionPorCategoria($id_categoria) {
        if ($id_categoria == 1 || $id_categoria == 2) {
            $_SESSION['categoria_padre'] = $id_categoria;
        }
        set_time_limit(12000);
        $searchModel = new \common\models\VidrieraSearch(['categoria_id' => $id_categoria, 'categoria_padre' => $id_categoria]);
        $dataProvider = $searchModel->search(null);
        $dataProvider->getPagination()->setPageSize(7);
        $telas = \common\models\Vidriera::find()->joinWith('categoria')->where(['categoria_id' => $id_categoria])->orWhere(['categoria_padre' => $id_categoria])->limit(7)->orderBy('categoria_id, orden_vidriera')->all();
        return $this->render('porCategoria', ['dataProvider' => $dataProvider]);
    }

    public function actionPorVidriera($id) {
        $searchModel = new \common\models\ItemVidrieraSearch(['vidriera_id' => $id]);
        $dataProvider = $searchModel->searchConStock(null);
        $dataProvider->getPagination()->setPageSize(50);
        $vidriera = \common\models\Vidriera::findOne($id);
        return $this->render('porVidriera', ['vidriera' => $vidriera, 'dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function beforeAction($action) {
//        if ($action->id == "agregar-item") {
        $session = Yii::$app->session;
        if ($session['carrito'] == '') {
            $carrito = new \common\models\Carrito();
            $carrito->save();
            $session['carrito'] = $carrito->id_carrito;
        }
//        }

        return parent::beforeAction($action);
    }

    public function actionDeleteItem() {
        $id = \Yii::$app->request->post('id');
        $item = \common\models\ItemCarrito::findOne($id);
        if ($item != null) {
            $item->delete();
            return $id;
        }
//        return count($item->carrito->itemCarritos);
    }

    public function actionAgregarItem() {
        $session = Yii::$app->session;
        $data = \Yii::$app->request->post();
        $id = $data['id'];
        $cantidad = $data['cantidad'];
        $item = new \common\models\ItemCarrito([
            'carrito_id' => $session['carrito'],
            'cantidad' => $cantidad,
            'articulo_id' => $id]);
        $item->save();

        return count($item->carrito->itemCarritos);

//        return $items;
    }

    function actionAumentarCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        $itemCarrito->cantidad += 1;
        $itemCarrito->save();
        return $itemCarrito->cantidad;
    }

    function actionDisminuirCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        if ($itemCarrito->cantidad > 0) {
            $itemCarrito->cantidad -= 1;
            $itemCarrito->save();
        }
        return $itemCarrito->cantidad;
    }

    function actionCrearConsulta() {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($carrito == null) {
            return $this->goBack();
        }
        if ($carrito->cliente_id == null) {
            $model = new \common\models\Cliente();
        } else {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
        }


//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $carrito->cliente_id = $model->id_cliente;
            $carrito->save();
            $carrito->sendMail();
            return $this->redirect(['finalizar-consulta', 'id_carrito' => $carrito->id_carrito]);
        }
        return $this->render('crearConsulta', ['model' => $model, 'carrito' => $carrito]);
    }

    function actionFinalizarConsulta($categoria_padre = 1, $id_carrito) {
        $carrito = \common\models\Carrito::findOne($id_carrito);
        $carrito->confirmado = true;
        $carrito->timestamp = date("Y-m-d H:i:s");
        $carrito->save();
        $_SESSION['carrito'] = '';
        return $this->render('finalizarConsulta', ['id_carrito' => $id_carrito]);
    }

    function actionUpdateConsulta($id_carrito) {
        $_SESSION['carrito'] = $id_carrito;

        return $this->redirect(['crear-consulta']);
    }

    function actionBuscar() {
        $vidrieras = [];
        $busqueda = \Yii::$app->request->get('busqueda');
        if ($busqueda != "") {
            $vidrieras = \common\models\Vidriera::find()->joinWith('categoria')
                            ->where(['like', 'nombre', '%' . $busqueda . '%', false])
                            ->orWhere(['like', 'nombre_categoria', '%' . $busqueda . '%', false])->all();
        }
//        $model = new \common\models\CategoriaSearch(['nombre_categoria'=>$busqueda]);
//        $dataprovider = $model->search(null);
//        $dataprovider->setPagination(false);
        return $this->render('busqueda', ['vidrieras' => $vidrieras, 'busqueda' => $busqueda]);
    }

    public function actionDescargarPdf() {
        $pdf = \common\models\PdfReport::findOne(Yii::$app->request->post("PdfReport")['id_pdf_report']);
        if ($pdf) {
            $path = Yii::getAlias('@backend') . '/uploads/pdf-report';
            $file = $path . "/$pdf->id_pdf_report.pdf";
            if (file_exists($file)) {
                return Yii::$app->response->sendFile($file, $pdf->nombre_pdf . ".pdf");
            }
        }
        if (Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

}
