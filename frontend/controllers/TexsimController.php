<?php

namespace frontend\controllers;

use yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class TexsimController extends \yii\web\Controller {

    public function actionIndex() {
//        $session = Yii::$app->session;
//        $session->destroy();
        return $this->render('index');
    }

    public function actionHogar() {
        $categorias = \common\models\Categoria::find()->where(['categoria_padre' => 1])->orderBy('orden_categoria')->all();
        return $this->render('list', [
                    'categoria_padre' => 1,
                    'categorias' => $categorias,
        ]);
    }

    public function actionModa() {
        $categorias = \common\models\Categoria::find()->where(['categoria_padre' => 2])->orderBy('orden_categoria')->all();

        return $this->render('list', [
                    'categorias' => $categorias,
                    'categoria_padre' => 2
        ]);
    }

    public function actionCategorias($id) {
//        }
        $model = \common\models\Tela::findOne($id);
        $categoria_padre = $model->categoria->categoria_padre;
        return $this->render('estampados', ['model' => $model, 'categoria_padre' => $categoria_padre]);
    }

    public function actionEstampados($id) {
        $model = \common\models\Tela::findOne($id);
        $categoria_padre = $model->categoria->categoria_padre;
        return $this->render('estampados', ['model' => $model, 'categoria_padre' => $categoria_padre]);
    }

    public function actionDeleteItem($id) {
//        unset($_SESSION['items'][$id]);
        $item = \common\models\ItemCarrito::findOne($id);
        if ($item != null) {
            $item->delete();
        }
    }

    public function actionAgregarItem() {
        $session = Yii::$app->session;
        if ($session['carrito'] == '') {
            $carrito = new \common\models\Carrito();
            $carrito->save();
            $session['carrito'] = $carrito->id_carrito;
        }
        $data = \Yii::$app->request->post();
        $id = $data['id'];
        $cantidad = $data['cantidad'];
        $item = new \common\models\ItemCarrito([
            'carrito_id' => $session['carrito'],
            'cantidad' => $cantidad,
            'disenio_id' => $id]);
        $item->save();

//        return $items;
    }

    public function beforeAction($action) {
        $session = Yii::$app->session;
        if ($session['carrito'] == null) {
            $session->open();
            $session['carrito'] = '';
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

//    function getCantidadItems() {
//        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
//        return count($carrito->itemCarritos);
////        return 0;
//    }


    function actionCarrito($categoria_padre) {
        $id_carrito = $_SESSION['carrito'];
        return $this->render('cart', ['categoria_padre' => $categoria_padre, 'id_carrito' => $id_carrito]);
    }

    function actionCrearConsulta($categoria_padre) {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($carrito->cliente_id == null) {
            $model = new \common\models\Cliente();
        } else {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
        }


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $carrito->cliente_id = $model->id_cliente;
            $carrito->save();
            $carrito->sendMail();
            return $this->redirect(['finalizar-consulta', 'categoria_padre' => $categoria_padre, 'id_carrito' => $carrito->id_carrito]);
        }
        return $this->render('crearConsulta', ['categoria_padre' => $categoria_padre, 'model' => $model, 'id_carrito' => $carrito->id_carrito]);
    }

    function actionCrearConsultaWhatsApp($categoria_padre) {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($carrito->cliente_id == null) {
            $model = new \common\models\Cliente();
        } else {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
        }
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $carrito->cliente_id = $model->id_cliente;
            $carrito->confirmado = true;
            $carrito->save();
            $carrito->sendMail();
            $_SESSION['carrito'] = '';
            $mensaje = rawurlencode($carrito->getConsultaWhatsApp());
            $url = "https://api.whatsapp.com/send?phone=541135386219&text=" . $mensaje . "&source=&data=#";
            return $this->redirect(['ir-whats-app', 'url' => $url]);
//            return $this->redirect(['https://api.whatsapp.com/send?phone=541135386219&text='.$mensaje."&source=&data=#"]);
        }
//        $response = \yii\helpers\Url::to(['crear-consulta', 'categoria_padre' => $categoria_padre]);
//        return $response;
        return $this->render('crearConsulta', ['categoria_padre' => $categoria_padre, 'model' => $model, 'id_carrito' => $carrito->id_carrito]);
    }

    function actionIrWhatsApp($url) {
//        $categoria_padre=1;
//        $model = new \common\models\Cliente();
//        return $this->render('crearConsulta', ['url'=>$url,'categoria_padre' => $categoria_padre, 'model' => $model]);
        return $this->render('irWhatsapp', ['url' => $url]);
    }

    function confirmarConsulta() {
        $carrito = common\models\Carrito::findOne($_SESSION['carrito']);
        $carrito->confirmado = true;
        $carrito->timestamp = date("Y-m-d H:i:s");
        $carrito->save();
    }

    function actionFinalizarConsulta($categoria_padre, $id_carrito) {
        $carrito = \common\models\Carrito::findOne($id_carrito);
        $carrito->confirmado = true;
        $carrito->timestamp = date("Y-m-d H:i:s");
        $carrito->save();
        $_SESSION['carrito'] = '';
        return $this->render('contacto', ['categoria_padre' => $categoria_padre, 'id_carrito' => $id_carrito]);
    }

    function actionUpdateConsulta($categoria_padre, $id_carrito) {
        $_SESSION['carrito'] = $id_carrito;

        return $this->redirect(['crear-consulta', 'categoria_padre' => $categoria_padre]);
    }

    function actionDeleteCarrito() {
        $items = \common\models\ItemCarrito::findAll(['carrito_id' => $_SESSION['carrito']]);
        foreach ($items as $item) {
            $item->delete();
        }
    }

    function actionAumentarCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        $itemCarrito->cantidad += 1;
        $itemCarrito->save();
    }

    function actionDisminuirCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        if ($itemCarrito->cantidad > 0) {
            $itemCarrito->cantidad -= 1;
            $itemCarrito->save();
        }
    }

}
