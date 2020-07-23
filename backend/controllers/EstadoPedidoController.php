<?php


namespace backend\controllers;




use common\models\Articulo;
use yii\helpers\Html;
use yii\helpers\Json;
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

}
