<?php

namespace frontend\controllers;

use Yii;

class SitioController extends \yii\web\Controller {


    
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCategoriaPadre($valor) {
        $_SESSION['categoria_padre'] = $valor;
        return $this->redirect(['index']);
    }

    public function actionHogar() {
        $_SESSION['categoria_padre'] = 1;
        return $this->redirect(['por-categoria','id_categoria'=>$_SESSION['categoria_padre']]);
    }

    public function actionModa() {
        $_SESSION['categoria_padre'] = 2;
        return $this->redirect(['por-categoria','id_categoria'=>$_SESSION['categoria_padre']]);
    }

    public function actionPorCategoria($id_categoria) {
        set_time_limit(12000);
        $telas = \common\models\Vidriera::find()->joinWith('categoria')->where(['categoria_id' => $id_categoria])->orWhere(['categoria_padre'=>$id_categoria])->limit(5)->all();
        return $this->render('porCategoria', ['telas' => $telas]);
    }
    
    public function actionPorVidriera($id){
        $vidriera = \common\models\Vidriera::findOne($id);
        return $this->render('porVidriera',['vidriera'=>$vidriera]);
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
    
}