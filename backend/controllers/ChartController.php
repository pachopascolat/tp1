<?php


namespace backend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\Controller;


class ChartController extends Controller
{

    public function behaviors()
    {
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
//                        'actions' => ['index-pedidos','index', 'create', 'view', 'update', 'index-por-categoria', 'delete'],
                        'roles' => ['ventasManager'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex(){
//        $this->layout = 'bootstrap4';
        return $this->render('index');
    }

    public function actionGetArticulos(){
//        $articulos =
//            '[{"articulo":"BBL1500","nom":"Batista Blanca","piezas":"11","mts":"550.00","mts0":"550.00","delta":"0.0000"},{"articulo":"BOT2800","nom":"Black Out Textil","piezas":"299","mts":"9248.90","mts0":"9248.90","delta":"0.0000"},{"articulo":"BRO1500","nom":"Broderie 1.50","piezas":"42","mts":"2107.00","mts0":"2107.00","delta":"0.0000"},{"articulo":"BTE6535","nom":"Batista Estampada","piezas":"7","mts":"350.00","mts0":"350.00","delta":"0.0000"},{"articulo":"BTL6535","nom":"Batista Color","piezas":"1077","mts":"53691.00","mts0":"53691.00","delta":"0.0000"},{"articulo":"BTP8020","nom":"Pintorcito","piezas":"297","mts":"17820.00","mts0":"17820.00","delta":"0.0000"},{"articulo":"CCE2400","nom":"Copy Cotton Estampado","piezas":"35","mts":"3498.00","mts0":"3498.00","delta":"0.0000"},{"articulo":"CCL2400","nom":"Copy Cotton Liso","piezas":"788","mts":"78601.00","mts0":"78601.00","delta":"0.0000"},{"articulo":"CGT1400","nom":"Cristal Glitter Transparente","piezas":"129","mts":"6450.00","mts0":"6450.00","delta":"0.0000"},{"articulo":"CORLI12","nom":"Cortina Lisa TML X 12","piezas":"1","mts":"12.00","mts0":"12.00","delta":"0.0000"},{"articulo":"CRE0010","nom":"Cristal Estampado","piezas":"1526","mts":"76299.00","mts0":"76299.00","delta":"0.0000"},{"articulo":"CRL0020","nom":"Cristal Liso Color","piezas":"183","mts":"9150.00","mts0":"9150.00","delta":"0.0000"},{"articulo":"CRPE1500","nom":"Crepé Estampado","piezas":"11","mts":"554.90","mts0":"554.90","delta":"0.0000"},{"articulo":"CRT0010","nom":"Cristal Transparente 0.10 Mm","piezas":"265","mts":"13250.00","mts0":"13250.00","delta":"0.0000"},{"articulo":"CRT0015","nom":"Cristal Transparente 0.15 Mm","piezas":"1687","mts":"84350.00","mts0":"84350.00","delta":"0.0000"},{"articulo":"CRT0020","nom":"Cristal Transparente 0.20 Mm","piezas":"1084","mts":"54200.00","mts0":"54200.00","delta":"0.0000"},{"articulo":"CSH1600","nom":"Corderito Sherpa","piezas":"1292","mts":"32853.00","mts0":"32853.00","delta":"0.0000"},{"articulo":"CUERE00","nom":"Cuerina Estampada","piezas":"69","mts":"2070.00","mts0":"2070.00","delta":"0.0000"},{"articulo":"CUEREB0","nom":"Cuerina Est. Con Borde","piezas":"143","mts":"4290.00","mts0":"4290.00","delta":"0.0000"},{"articulo":"CUERL00","nom":"Cuerina Lisa","piezas":"998","mts":"29931.00","mts0":"29931.00","delta":"0.0000"},{"articulo":"CUP1400","nom":"Cuerina Plavinil","piezas":"341","mts":"17050.00","mts0":"17050.00","delta":"0.0000"},{"articulo":"DFL1600","nom":"Deportivo Frizado Liso","piezas":"1498","mts":"34098.10","mts0":"34098.10","delta":"0.0000"},{"articulo":"DFM1600","nom":"Deportivo Frizado Melange","piezas":"299","mts":"5904.30","mts0":"5904.30","delta":"0.0000"},{"articulo":"FBE1500","nom":"Fibrana Estampada 1.50","piezas":"1774","mts":"91479.00","mts0":"91479.00","delta":"0.0000"},{"articulo":"FBL1500","nom":"Fibrana Lisa","piezas":"2","mts":"100.00","mts0":"100.00","delta":"0.0000"},{"articulo":"FRE1400","nom":"Friselina Estampada","piezas":"432","mts":"43200.00","mts0":"43200.00","delta":"0.0000"},{"articulo":"FRZ1600","nom":"Friza Lisa","piezas":"677","mts":"14506.90","mts0":"14506.90","delta":"0.0000"},{"articulo":"FRZB1600","nom":"Friza Batik","piezas":"19","mts":"312.20","mts0":"312.20","delta":"0.0000"},{"articulo":"FRZM1600","nom":"Friza Melange","piezas":"158","mts":"3480.40","mts0":"3480.40","delta":"0.0000"},{"articulo":"GOB3000","nom":"Gobelino","piezas":"663","mts":"23734.60","mts0":"23734.60","delta":"0.0000"},{"articulo":"GSE1500","nom":"Gasa Estampada","piezas":"11","mts":"651.40","mts0":"651.40","delta":"0.0000"},{"articulo":"HCRO1400","nom":"Hule Crochet","piezas":"96","mts":"1849.00","mts0":"1849.00","delta":"0.0000"},{"articulo":"HDF1400","nom":"Hule Doble Faz","piezas":"340","mts":"17000.00","mts0":"17000.00","delta":"0.0000"},{"articulo":"HFEL1400","nom":"Hule Con Felpa","piezas":"70","mts":"3500.00","mts0":"3500.00","delta":"0.0000"},{"articulo":"HFRI1400","nom":"Hule Con Friselina","piezas":"33","mts":"1650.00","mts0":"1650.00","delta":"0.0000"},{"articulo":"HGC1400","nom":"Hule Gofrado Cuadrille","piezas":"183","mts":"6850.00","mts0":"6850.00","delta":"0.0000"},{"articulo":"HGF1400","nom":"Hule Gofrado Floral","piezas":"271","mts":"13550.00","mts0":"13550.00","delta":"0.0000"},{"articulo":"HGO1400","nom":"Hule Gofrado Ondulado","piezas":"863","mts":"25890.00","mts0":"25890.00","delta":"0.0000"},{"articulo":"HTROQ00","nom":"Hule Troquelado","piezas":"521","mts":"5210.00","mts0":"5210.00","delta":"0.0000"},{"articulo":"KIE1500","nom":"Kiev Estampado","piezas":"3","mts":"242.50","mts0":"242.50","delta":"0.0000"},{"articulo":"MATD000","nom":"Mat Dobby","piezas":"46","mts":"690.00","mts0":"690.00","delta":"0.0000"},{"articulo":"MATE000","nom":"Mat Estampado","piezas":"526","mts":"7890.00","mts0":"7890.00","delta":"0.0000"},{"articulo":"MATL000","nom":"Mat Liso","piezas":"179","mts":"2685.00","mts0":"2685.00","delta":"0.0000"},{"articulo":"MDL1600","nom":"Modal Liso","piezas":"95","mts":"1972.50","mts0":"1972.50","delta":"0.0000"},{"articulo":"MFE2400","nom":"Microfibra Estampada 2.40","piezas":"2320","mts":"231071.00","mts0":"231071.00","delta":"0.0000"},{"articulo":"MFES1500","nom":"Microfibra Estampada Pesada 1.50","piezas":"9","mts":"800.00","mts0":"800.00","delta":"0.0000"},{"articulo":"MFJ2400","nom":"Microfibra Jacquard 2.40","piezas":"268","mts":"26756.00","mts0":"26756.00","delta":"0.0000"},{"articulo":"MFL1500","nom":"Microfibra Lisa 1.50","piezas":"13366","mts":"1335996.00","mts0":"1335996.00","delta":"0.0000"},{"articulo":"MFL2400","nom":"Microfibra Lisa 2.40","piezas":"2363","mts":"233663.00","mts0":"233663.00","delta":"0.0000"},{"articulo":"MFL2400P","nom":"Microfibra Lisa 2.40 80gs","piezas":"36","mts":"3572.00","mts0":"3572.00","delta":"0.0000"},{"articulo":"MVB1600","nom":"Micro Velvet Bubbles","piezas":"1","mts":"16.20","mts0":"16.20","delta":"0.0000"},{"articulo":"MVE1600","nom":"Micro Velvet Estampado","piezas":"247","mts":"4200.70","mts0":"4200.70","delta":"0.0000"},{"articulo":"MVL1600","nom":"Micro Velvet Liso","piezas":"358","mts":"6062.80","mts0":"6062.80","delta":"0.0000"},{"articulo":"PBE1600","nom":"Polar Barato Estampado","piezas":"57","mts":"1459.60","mts0":"1459.60","delta":"0.0000"},{"articulo":"PCL144H","nom":"Percal Liso 144 Hilos","piezas":"88","mts":"8798.00","mts0":"8798.00","delta":"0.0000"},{"articulo":"PCL2800","nom":"Percal 2.80","piezas":"348","mts":"34730.00","mts0":"34730.00","delta":"0.0000"},{"articulo":"PELEC00","nom":"Paño De Electronica","piezas":"254","mts":"14641.50","mts0":"14641.50","delta":"0.0000"},{"articulo":"PLE1600","nom":"Polar Estampado 1.60","piezas":"2","mts":"39.50","mts0":"39.50","delta":"0.0000"},{"articulo":"PLF1600","nom":"POLAR LISO 1.60","piezas":"2","mts":"41.80","mts0":"41.80","delta":"0.0000"},{"articulo":"PLF2400","nom":"POLAR LISO 2.40","piezas":"2","mts":"38.50","mts0":"38.50","delta":"0.0000"},{"articulo":"PLL1600","nom":"Polar Liso 1.60","piezas":"269","mts":"6725.80","mts0":"6725.80","delta":"0.0000"},{"articulo":"PME0075","nom":"Paño Microfibra Estampado","piezas":"20","mts":"383.00","mts0":"383.00","delta":"0.0000"},{"articulo":"PME1500","nom":"Paño Microfibra Estampado","piezas":"197","mts":"12894.00","mts0":"12894.00","delta":"0.0000"},{"articulo":"PMF1500","nom":"Paño Microfibra 1.50","piezas":"485","mts":"36340.00","mts0":"36340.00","delta":"0.0000"},{"articulo":"PÑCO0900","nom":"Puño Liso Poliester","piezas":"4","mts":"49.00","mts0":"49.00","delta":"0.0000"},{"articulo":"PÑL0900","nom":"Puño Polyester C/ Lycra","piezas":"25","mts":"310.90","mts0":"310.90","delta":"0.0000"},{"articulo":"PÑTO0900","nom":"Puño Liso Poliester","piezas":"114","mts":"1628.70","mts0":"1628.70","delta":"0.0000"},{"articulo":"REP1600","nom":"Repasador Poliester","piezas":"47","mts":"3482.24","mts0":"3482.24","delta":"0.0000"},{"articulo":"REPXDOC","nom":"Repasadores X Docena","piezas":"4","mts":"60.00","mts0":"60.00","delta":"0.0000"},{"articulo":"SDE1500","nom":"Seda Estampada","piezas":"8","mts":"382.90","mts0":"382.90","delta":"0.0000"},{"articulo":"SFL1600","nom":"Seda Fria Lisa","piezas":"639","mts":"13783.70","mts0":"13783.70","delta":"0.0000"},{"articulo":"SPB1600","nom":"Set Polyester Brilloso","piezas":"1207","mts":"30023.00","mts0":"30023.00","delta":"0.0000"},{"articulo":"SPL1600","nom":"Set Polyester Liso","piezas":"713","mts":"17222.30","mts0":"17222.30","delta":"0.0000"},{"articulo":"TME1500","nom":"Tropical Mecanico Estampado","piezas":"559","mts":"27806.00","mts0":"27806.00","delta":"0.0000"},{"articulo":"TML1500","nom":"Tropical Mecánico","piezas":"6349","mts":"318054.00","mts0":"318054.00","delta":"0.0000"},{"articulo":"TML3000","nom":"Tropical Mecánico","piezas":"1","mts":"49.50","mts0":"49.50","delta":"0.0000"},{"articulo":"TMR1500","nom":"Tropical Mecanico Ratier 1.50","piezas":"174","mts":"10007.00","mts0":"10007.00","delta":"0.0000"},{"articulo":"TMR2100","nom":"Tropical Mecanico Ratier 2.10","piezas":"3","mts":"157.00","mts0":"157.00","delta":"0.0000"},{"articulo":"TMR3000","nom":"Tropical Mecanico Ratier 3mts","piezas":"285","mts":"15189.00","mts0":"15189.00","delta":"0.0000"},{"articulo":"TOAL000","nom":"Toalla Poliester","piezas":"586","mts":"29065.67","mts0":"29065.67","delta":"0.0000"},{"articulo":"TOAPOLY","nom":"Toalla Poliester","piezas":"30","mts":"1710.00","mts0":"1710.00","delta":"0.0000"},{"articulo":"TRF1500","nom":"Transfer Metalizado","piezas":"676","mts":"37660.00","mts0":"37660.00","delta":"0.0000"},{"articulo":"TSO1600","nom":"Termico Soft","piezas":"153","mts":"3720.80","mts0":"3720.80","delta":"0.0000"},{"articulo":"VLL3000","nom":"Voile Liso","piezas":"2713","mts":"135560.00","mts0":"135560.00","delta":"0.0000"},{"articulo":"VOALG1500","nom":"Voile Algodón","piezas":"3","mts":"172.20","mts0":"172.20","delta":"0.0000"},{"articulo":"YUTE000","nom":"Yute Liso","piezas":"300","mts":"30163.00","mts0":"30163.00","delta":"0.0000"}]'
//            ;
//        return $articulos;
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://10.10.1.51:8090/stockGralxArt/0/999')
            ->send();
        return Json::encode($response->getData());
    }

    public function actionGetVariantes($articulo){
//        $variantes =
//            '[{"variante":"0007","nom":"Gris Topo","piezas":"12","mts":"600.00","mts0":"600.00","delta":"0.0000"},{"variante":"0012","nom":"Azul Marino","piezas":"79","mts":"3950.00","mts0":"3950.00","delta":"0.0000"},{"variante":"0025","nom":"Vainilla","piezas":"7","mts":"350.00","mts0":"350.00","delta":"0.0000"},{"variante":"0030","nom":"Chocolate","piezas":"70","mts":"3490.00","mts0":"3490.00","delta":"0.0000"},{"variante":"0032","nom":"Beige","piezas":"54","mts":"2658.00","mts0":"2658.00","delta":"0.0000"},{"variante":"0040","nom":"Rojo","piezas":"233","mts":"11650.00","mts0":"11650.00","delta":"0.0000"},{"variante":"0047","nom":"Bordó","piezas":"57","mts":"2843.00","mts0":"2843.00","delta":"0.0000"},{"variante":"0050","nom":"Francia","piezas":"42","mts":"2100.00","mts0":"2100.00","delta":"0.0000"},{"variante":"0053","nom":"Azul Petróleo","piezas":"15","mts":"745.00","mts0":"745.00","delta":"0.0000"},{"variante":"0056","nom":"Aero","piezas":"24","mts":"1171.00","mts0":"1171.00","delta":"0.0000"},{"variante":"0060","nom":"Rosa","piezas":"2","mts":"100.00","mts0":"100.00","delta":"0.0000"},{"variante":"0066","nom":"Fucsia","piezas":"32","mts":"1600.00","mts0":"1600.00","delta":"0.0000"},{"variante":"0070","nom":"Celeste","piezas":"1","mts":"46.00","mts0":"46.00","delta":"0.0000"},{"variante":"0073","nom":"Celeste Policía","piezas":"108","mts":"5400.00","mts0":"5400.00","delta":"0.0000"},{"variante":"0081","nom":"Verde Benethon","piezas":"78","mts":"3900.00","mts0":"3900.00","delta":"0.0000"},{"variante":"0082","nom":"Verde Esmeralda","piezas":"3","mts":"150.00","mts0":"150.00","delta":"0.0000"},{"variante":"0083","nom":"Verde Manzana","piezas":"34","mts":"1700.00","mts0":"1700.00","delta":"0.0000"},{"variante":"0085","nom":"Verde Militar","piezas":"56","mts":"2774.00","mts0":"2774.00","delta":"0.0000"},{"variante":"0087","nom":"Verde Agua","piezas":"31","mts":"1550.00","mts0":"1550.00","delta":"0.0000"},{"variante":"0089","nom":"Verde Inglés","piezas":"3","mts":"150.00","mts0":"150.00","delta":"0.0000"},{"variante":"0090","nom":"Amarillo","piezas":"17","mts":"842.00","mts0":"842.00","delta":"0.0000"},{"variante":"0100","nom":"Naranja","piezas":"9","mts":"450.00","mts0":"450.00","delta":"0.0000"},{"variante":"0103","nom":"Salmon","piezas":"3","mts":"143.00","mts0":"143.00","delta":"0.0000"},{"variante":"0122","nom":"Turquesa","piezas":"20","mts":"1000.00","mts0":"1000.00","delta":"0.0000"},{"variante":"0123","nom":"Coral","piezas":"41","mts":"2029.00","mts0":"2029.00","delta":"0.0000"},{"variante":"0124","nom":"Lila","piezas":"13","mts":"650.00","mts0":"650.00","delta":"0.0000"},{"variante":"0142","nom":"Maiz","piezas":"33","mts":"1650.00","mts0":"1650.00","delta":"0.0000"}]'
//            ;
//        return $variantes;
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('http://10.10.1.51:8090/stockGralxArtxVariante/'.$articulo.'/0/999')
            ->send();
        return Json::encode($response->getData());
    }

    private function normalizarEstadistica($datos){
        $datosSorted = Json::decode($datos);
        ArrayHelper::multisort($datosSorted,'fecha',SORT_ASC);
        $fechas = ArrayHelper::getColumn($datosSorted,'fecha');
        $cantidades = ArrayHelper::getColumn($datosSorted,'mts0');
        return Json::encode(['fechas'=>$fechas,'cantidades'=>$cantidades]);
    }

    public function actionGetEstadisticasVariante($articulo,$variante){
        $dias = 10;
//        $datos = '[{"fecha":"2020-08-06","piezas":"204","mts":"6312.30","mts0":"6312.30","delta":"0.0000"},{"fecha":"2020-08-05","piezas":"204","mts":"6312.30","mts0":"6312.30","delta":"0.0000"},{"fecha":"2020-08-04","piezas":"204","mts":"6312.30","mts0":"6443.80","delta":"-0.0204"},{"fecha":"2020-08-03","piezas":"208","mts":"6443.80","mts0":"6443.80","delta":"0.0000"},{"fecha":"2020-07-31","piezas":"208","mts":"6443.80","mts0":"6571.20","delta":"-0.0194"},{"fecha":"2020-07-30","piezas":"212","mts":"6571.20","mts0":"6571.20","delta":"0.0000"},{"fecha":"2020-07-29","piezas":"212","mts":"6571.20","mts0":"6507.70","delta":"0.0098"},{"fecha":"2020-07-28","piezas":"210","mts":"6507.70","mts0":"6507.70","delta":"0.0000"},{"fecha":"2020-07-27","piezas":"210","mts":"6507.70","mts0":null,"delta":null}]';
//        return $this->normalizarEstadistica($datos);
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://10.10.1.51:8090/stockArtxVariantexDias/0/$articulo/$variante/$dias/0/999")
            ->send();
//        return Json::encode($response->getData());
        return $this->normalizarEstadistica(Json::encode($response->getData()));
//        return Json::encode($response->getData());
    }
    public function actionGetEstadisticasArticulo($articulo){
        $dias = 10;
//        $datos =
//            '[{"fecha":"2020-08-07","piezas":"299","mts":"9248.90","mts0":"9248.90","delta":"0.0000"},{"fecha":"2020-08-06","piezas":"299","mts":"9248.90","mts0":"9248.90","delta":"0.0000"},{"fecha":"2020-08-05","piezas":"299","mts":"9248.90","mts0":"9248.90","delta":"0.0000"},{"fecha":"2020-08-04","piezas":"299","mts":"9248.90","mts0":"9412.40","delta":"-0.0174"},{"fecha":"2020-08-03","piezas":"304","mts":"9412.40","mts0":"9412.40","delta":"0.0000"},{"fecha":"2020-07-31","piezas":"304","mts":"9412.40","mts0":"9539.80","delta":"-0.0134"},{"fecha":"2020-07-30","piezas":"308","mts":"9539.80","mts0":"9539.80","delta":"0.0000"},{"fecha":"2020-07-29","piezas":"308","mts":"9539.80","mts0":"9476.30","delta":"0.0067"},{"fecha":"2020-07-28","piezas":"306","mts":"9476.30","mts0":"9476.30","delta":"0.0000"}]'
//        ;
//        return $this->normalizarEstadistica($datos);
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl("http://10.10.1.51:8090/stockArtxDias/0/$articulo/$dias/0/999")
            ->send();
//        return Json::encode($response->getData());
        return $this->normalizarEstadistica(Json::encode($response->getData()));
//        return Json::encode($response->getData());
    }

    public function actionGetDeposito($deposito,$articulo,$variante=null){
        if($variante) {
            $url = "http://10.10.1.51:8090/stockArtxVariantexDias/$deposito/$articulo/$variante/0/0/999";
        }else{
            $url = "http://10.10.1.51:8090/stockArtxDias/$deposito/$articulo/0/0/999";
        }
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();

        $data = $response->getData();
        return Json::encode($data[0]??null);
    }

}
