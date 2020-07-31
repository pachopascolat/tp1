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
//        $clientes = Json::decode('[{"codfac":4562,"nom":"FREDDY CONDOR                                     ","cuit":"-------------"},{"codfac":2821,"nom":"LALY MARCONI                                      ","cuit":"0000000000000"},{"codfac":7824,"nom":"MARCELO CONTRERA                                  ","cuit":"20230125733  "},{"codfac":7166,"nom":"CONFEBLANC SRL                                    ","cuit":"30710867352  "},{"codfac":3329,"nom":"ENRIQUE CONDORI                                   ","cuit":"27938808193  "},{"codfac":9165,"nom":"WILY CONDE                                        ","cuit":"*************"},{"codfac":1480,"nom":"STECCONI OSCAR                                    ","cuit":"00000000000  "},{"codfac":747,"nom":"CONDORI GUAYGUA VICTOR HUGO                       ","cuit":"23603430239  "},{"codfac":6997,"nom":"MIRIAM GIACCONE                                   ","cuit":"27142164170  "},{"codfac":4688,"nom":"FIDEL CONDORI                                     ","cuit":"0000000000000"},{"codfac":7252,"nom":"ARMANDO CONDORI                                   ","cuit":"-------------"},{"codfac":6902,"nom":"PAULINA CONDORI ESCOBAR (POMPEYA)                 ","cuit":"-------------"},{"codfac":6534,"nom":"CONCEBIDA COLQUECHUIMA                            ","cuit":"7895468789798"},{"codfac":3670,"nom":"ESTEBAN CONTENTO                                  ","cuit":"0000000000000"},{"codfac":1977,"nom":"WALTER CONDORI                                    ","cuit":"1111111111111"},{"codfac":5065,"nom":"ROXANA CONDE                                      ","cuit":"-------------"},{"codfac":2002,"nom":"LORENA CONDE                                      ","cuit":"1111111111111"},{"codfac":7236,"nom":"ALEJANDRINA ALARCON                               ","cuit":"-------------"},{"codfac":2624,"nom":"PAOLA CONDORI ROMERO                              ","cuit":"27944477069  "},{"codfac":3087,"nom":"NATIVIDAD CHACON                                  ","cuit":"0000000000000"}]');
//        return Json::encode($clientes);
        return Json::encode($response->getData());
    }




}
