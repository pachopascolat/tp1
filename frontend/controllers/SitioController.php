<?php

namespace frontend\controllers;

use Yii;
use yii\httpclient\Client;
use mikehaertl\wkhtmlto\Pdf as Pdf2;
use mikehaertl\tmp\File;
use yii\widgets\ActiveForm;
use yii\web\Response;

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
            if (!$item->carrito->itemCarritos) {
//                $item->carrito->delete();
//                unset($_SESSION['carrito']);
            }
            return $id;
        }
//        return count($item->carrito->itemCarritos);
    }

    public function actionAgregarItem() {
        $session = Yii::$app->session;
        $data = \Yii::$app->request->post();
        $id = $data['id'];
        $imagen_id = $data['imagen_id'];
        $cantidad = $data['cantidad'];
        $item = new \common\models\ItemCarrito([
            'carrito_id' => $session['carrito'],
            'cantidad' => $cantidad,
            'imagen_id' => $imagen_id,
            'articulo_id' => $id]);
        $item->save();

        return count($item->carrito->itemCarritos);

//        return $items;
    }

    public function actionAgregarItemDesdeBuscador() {
        $session = Yii::$app->session;
        $data = \Yii::$app->request->post();
        $id = $data['id'];
        $imagen_id = \common\models\Articulo::findOne($id)->imagen_id ?? null;
        $cantidad = 1;
        $item = new \common\models\ItemCarrito([
            'carrito_id' => $session['carrito'],
            'cantidad' => $cantidad,
            'imagen_id' => $imagen_id,
            'articulo_id' => $id]);
        $item->save();

        return $this->renderAjax('cart', ['id_carrito' => $session['carrito']]);

//        return count($item->carrito->itemCarritos);
//        return $items;
    }

    public function actionDatosCodigo() {
//        $session = Yii::$app->session;
        $data = \Yii::$app->request->post();
        $code = $data['code'];


        $curl = new \linslin\yii2\curl\Curl();
//get http://example.com/
        $response = $curl->get("http://7633081eb66a.sn.mynetname.net/rollo/$code");
        // $response = $curl->get("http://jsonplaceholder.typicode.com/todos/1");
        // return json_encode($curl);
        $response = json_decode($response);
        if ($curl->errorCode === null) {
            $tela_id = $response->articulo;
            $color_id = $response->variante;
            $unidad = $response->unidad;
            $cantidad = intval($response->cantidad);
            return $this->agregarDesdeCodigo($tela_id, $color_id, $unidad, $code, $cantidad);
        } else {

//            $tela_id = 'MFES1500';
//            $color_id = 260;
//            $cantidad = 50;
//            $unidad = 'MTS';
//            return $this->agregarDesdeCodigo($tela_id, $color_id, $unidad, $code, $cantidad);
            // List of curl error codes here https://curl.haxx.se/libcurl/c/libcurl-errors.html
            switch ($curl->errorCode) {

                case 6:
                    //host unknown example
                    break;
            }
        }

        return json_encode($response);

//        echo $output;
    }

    public function agregarDesdeCodigo($tela_id, $color_id, $unidad, $code, $cantidad) {
        $session = Yii::$app->session;
//        $data = \Yii::$app->request->post();
//        $tela_id = $data['tela_id'];
//        $color_id = intval($data['color_id']);
        $articulo = \common\models\Articulo::find()->joinWith('tela')->where(['codigo_color' => $color_id, 'codigo_tela' => $tela_id])->one();
//        $cantidad = $data['cantidad'];
        if ($articulo) {
            $item = new \common\models\ItemCarrito([
                'carrito_id' => $session['carrito'],
                'cantidad' => $cantidad,
                'piezas' => 1,
                'imagen_id' => $articulo->imagen_id ?? null,
                'unidad' => $unidad,
                'serie' => $code,
                'articulo_id' => $articulo->id_articulo]);
            if ($item->save()) {
                return count($item->carrito->itemCarritos);
            }
            return json_encode($item->toArray());
        }
        return false;
    }

    function actionAumentarCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        $itemCarrito->piezas += 1;
        $itemCarrito->save();
        return $itemCarrito->piezas;
    }
    
    function actionActualizarCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        $itemCarrito->cantidad = \Yii::$app->request->post('cantidad');
        $itemCarrito->save();
        return $itemCarrito->cantidad;
    }
    function actionActualizarPiezas() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        $itemCarrito->piezas = \Yii::$app->request->post('piezas');
        $itemCarrito->save();
        return $itemCarrito->piezas;
    }
    
//    function actionActualizarItem() {
//        $model = new \common\models\ItemCarrito();
//        if($model->load(\Yii::$app->request->post())){
//            $item = $model->findOne($model->id_item_carrito);
//            $item->save();
//            return json_encode($item);
//        }
//    }

    function actionDisminuirCantidad() {
        $key = \Yii::$app->request->post('id');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);
        if ($itemCarrito->piezas > 0) {
            $itemCarrito->piezas -= 1;
            $itemCarrito->save();
        }
        return $itemCarrito->cantidad;
    }

    function actionCambiarPrecio() {
        $key = \Yii::$app->request->post('id');
        $precio = \Yii::$app->request->post('precio');
        $itemCarrito = \common\models\ItemCarrito::findOne($key);

        $itemCarrito->precio = $precio;
        if ($itemCarrito->save())
            return $itemCarrito->precio;
        return 0;
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

    function actionTerminar() {
        $_SESSION['carrito'] = '';
        return $this->redirect('index');
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
                    ->orWhere(['like', 'nombre_categoria', '%' . $busqueda . '%', false])
                    ->andWhere(['<>', 'categoria_id', \common\models\Categoria::PDF])
                    ->all();
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

    function actionCrearConsultaWhatsApp() {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($carrito == null) {
            if (Yii::$app->request->referrer) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->goHome();
            }
        }
        if ($carrito->cliente_id == null) {
            $model = new \common\models\Cliente();
        } else {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
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
        }

        return $this->render('crearConsulta', ['model' => $model, 'carrito' => $carrito]);
    }

    function actionIrWhatsApp($url) {
        return $this->render('irWhatsapp', ['url' => $url]);
    }

    function actionLeerCodigo() {
        return $this->render('leerMatrixCode');
    }

    function actionBuscarCliente() {
//        $data = Yii::$app->request->post();
        $model = new \common\models\Cliente();
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($data = \Yii::$app->request->post()) {
            $model = \common\models\Cliente::findOne([$data['id_cliente']]);
            $carrito->cliente_id = $model->id_cliente;
            $carrito->direccion_envio = $model->direccion_envio;
            $carrito->save();
        }
//        return $this->render('crearConsulta', ['model' => $model, 'carrito' => $carrito]);
        return $this->renderAjax('_clientePedido', ['model' => $model, 'carrito' => $carrito]);
    }

    function actionPedidoFacturacion() {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        if ($carrito == null) {
            return $this->goBack();
        }

        $model = new \common\models\Cliente(['agendado' => 1]);

        if ($carrito->cliente_id) {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $carrito->load(\Yii::$app->request->post());
            $carrito->para_facturar = true;
            if ($carrito->vendedor_id == null) {
                $carrito->vendedor_id = \Yii::$app->user->getId();
            }
            $carrito->cliente_id = $model->id_cliente;
            $carrito->save();
            $carrito->sendMailFacturacion();
            return $this->redirect(['finalizar-consulta', 'id_carrito' => $carrito->id_carrito]);
        }
        return $this->render('crearConsulta', ['model' => $model, 'carrito' => $carrito]);
    }

    function actionImprimirDesdeBackend($carrito_id) {
        $carrito = \common\models\Carrito::findOne($carrito_id);
        $this->imprimirCarrito($carrito);
        return $this->render('finalizar-consulta', ['id_carrito' => $carrito->id_carrito]);
    }

    function imprimirCarrito(\common\models\Carrito $carrito, $cliente = null) {

        if ($cliente == null) {
            $cliente = \common\models\Cliente::findOne($carrito->cliente_id);
        }
        $carrito->para_facturar = true;
        $carrito->confirmado = true;

        if ($carrito->vendedor_id == null) {
            $carrito->vendedor_id = \Yii::$app->user->getId();
        }
        $carrito->cliente_id = $cliente->id_cliente;
        $carrito->save();
        $header = $this->renderPartial('_pdfHeader', ['carrito' => $carrito]);
        $header = "hola";
        $options = [
            'binary' => Yii::getAlias("@vendor/wkhtmltopdf"),
            'no-outline', // Make Chrome not complain
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'encoding' => 'UTF-8',
            // Default page options
            'disable-smart-shrinking',
            'user-style-sheet' => Yii::getAlias("@frontend/web/css/pdfStyle.css"),
            'header-html' => $header,
        ];

        $pdf = new Pdf2($options);
        $paginas = array_chunk($carrito->itemCarritos, 8);
        foreach ($paginas as $nro_hoja => $items) {
            $pdf->addPage($this->renderPartial('_reportPedido', ['carrito' => $carrito, 'items' => $items, 'nro_hoja' => $nro_hoja + 1]));
        }

        if (!$pdf->send("Pedido-$carrito->id_carrito.pdf")) {
            throw new \Exception('Could not create PDF: ' . $pdf->getError());
        }
    }

    function actionImprimirPedido() {

        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);

//        if ($carrito == null) {
//            return $this->goBack();
//        }
//        
        $model = new \common\models\Cliente(['agendado' => 1]);

        if ($carrito->cliente_id) {
            $model = \common\models\Cliente::findOne($carrito->cliente_id);
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $carrito->load(\Yii::$app->request->post());
            $carrito->cliente_id = $model->id_cliente;
            $carrito->save();
//            $this->imprimirCarrito($carrito, $model);
            return $this->redirect(['imprimir-desde-backend', 'carrito_id' => $carrito->id_carrito]);
        }

        return $this->render('crearConsulta', ['model' => $model, 'carrito' => $carrito]);
    }

    function actionLimpiarCliente() {
        $carrito = \common\models\Carrito::findOne($_SESSION['carrito']);
        $model = new \common\models\Cliente(['agendado' => 1]);
        $carrito->cliente_id = $model;
//        $carrito->save();
//        $carrito->direccion_envio = $model->direccion_envio;
        return $this->renderAjax('_clientePedido', ['model' => $model, 'carrito' => $carrito]);
    }

}
