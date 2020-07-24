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
            ->setFormat(Client::FORMAT_JSON)
            //            ->setData(['name' => 'John Doe', 'email' => 'johndoe@domain.com'])
//            ->setOptions([
//                'proxy' => 'tcp://proxy.example.com:5100', // use a Proxy
//                'timeout' => 5, // set timeout to 5 seconds for the case server is not responding
//            ])
            ->send();
        return $response;
    }

}
