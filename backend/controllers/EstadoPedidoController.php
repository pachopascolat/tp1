<?php


namespace backend\controllers;




use common\models\Articulo;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\Controller;

class EstadoPedidoController extends Controller {


    public function actionIndex()
    {
        $this->layout = 'bootstrap4';
        return $this->render('index');
    }

    public function actionGetItemData(){
        $client = new Client();
        $articulos = Articulo::find()->all();
        $fp = fopen('fichero.csv', 'w');
        fputcsv($fp, ['codigo_tela','codigo_variante','itemdata']);

        foreach ($articulos as $articulo){
            if($articulo->tela) {
                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl("http://10.10.1.51:8090/itemdata/" . $articulo->tela->codigo_tela . "/" . sprintf("%04d",$articulo->codigo_color))
                    ->send();
                if ($response->getData()) {
                    fputcsv($fp, $response->getData());
                }
            }
        }
        \Yii::$app->response->sendFile('fichero.csv');
    }

    public function actionGetPhoto($codigo,$variante){
        $articulo = Articulo::find()->joinWith('tela')->where(['codigo_tela'=>trim($codigo),'codigo_color'=>trim($variante)])->one();
        if($articulo){
            $url = $articulo->getUrl();
            return $url;
//            return Html::img($url);
        }
        return null;
    }

    public function actionPedidosEnCurso(){
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://10.10.1.51:8000/pedidosEnCurso')
//            ->setFormat(Client::FORMAT_JSON)
            //            ->setData(['name' => 'John Doe', 'email' => 'johndoe@domain.com'])
//            ->setOptions([
//                'proxy' => 'tcp://proxy.example.com:5100', // use a Proxy
//                'timeout' => 5, // set timeout to 5 seconds for the case server is not responding
//            ])
            ->send();
        return Json::encode($response->getData());
    }
    public function actionPedidosItems($id){
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://10.10.1.51:8090/pedidosItems/$id")
//            ->setFormat(Client::FORMAT_JSON)
            //            ->setData(['name' => 'John Doe', 'email' => 'johndoe@domain.com'])
//            ->setOptions([
//                'proxy' => 'tcp://proxy.example.com:5100', // use a Proxy
//                'timeout' => 5, // set timeout to 5 seconds for the case server is not responding
//            ])
            ->send();
        return Json::encode($response->getData());
    }

    public function actionCrearPedido(){
        $this->layout = 'bootstrap4';
        return $this->render('create');
    }

    public function actionBuscarCliente($textsearch,$page=1,$pagination=20){
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://10.10.1.51:8090/clientes/$textsearch/$page/$pagination")
            ->send();
        return Json::encode($response->getData());
    }


}
