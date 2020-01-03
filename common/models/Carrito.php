<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrito".
 *
 * @property int $id_carrito
 * @property int $cliente_id
 * @property string $timestamp
 *
 * @property Cliente $cliente
 * @property ItemCarrito[] $itemCarritos
 */
class Carrito extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cliente_id','vendedor_id'], 'integer'],
            [['timestamp','direccion_envio','observaciones'], 'safe'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id_cliente']],
            [['vendedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['vendedor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_carrito' => Yii::t('app', 'Nro Consulta'),
            'cliente_id' => Yii::t('app', 'Cliente ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente() {
        return $this->hasOne(Cliente::className(), ['id_cliente' => 'cliente_id']);
    }
    public function getVendedor() {
        return $this->hasOne(User::className(), ['id' => 'vendedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCarritos() {
        return $this->hasMany(ItemCarrito::className(), ['carrito_id' => 'id_carrito']);
    }

    public function getConsultaWhatsApp() {
        $cliente = Cliente::findOne($this->cliente_id);
        $mensaje = "Pedido: $this->id_carrito \n";
        if ($cliente != null) {
            $mensaje .= "Cliente: $cliente->nombre_cliente, \n";
            $mensaje .= "Email: $cliente->mail_cliente \n";
            if ($this->itemCarritos != null) {
                foreach ($this->itemCarritos as $item) {
                    $cant = $item->cantidad;
//                    $img = GalleryImage::findOne($item->disenio_id);
                    $codigo_diseño = $item->articulo->codigo_color;
                    $tela = $item->articulo->tela;
//                    $tipo = $item->getTipoTela();
                    $mensaje .= "$cant rollos de $tela->codigo_tela $tela->nombre_tela  codigo $codigo_diseño \n";
                }
            }
        }
        return $mensaje;
    }

    public function sendMail() {
        $message = Yii::$app->mailer->compose('mailConsulta', ['carrito' => $this]);



        $message->setFrom('no_reply@texsim.com.ar')
//                ->setBcc('patriciopascolat@gmail.com')
                ->setBcc(['dgvizaq@gmailpatriciopascolat@gmail.com'])
//                ->setTo('pedidos@texsim.com.ar')
                ->setSubject('Se ha realizado la consulta nro ' . $this->id_carrito)
//                ->setTextBody('EL cliente '.$this->cliente->nombre_cliente."\n".
//                        "tel: ".$this->cliente->telefono."\n".
//                        "email: ".$this->cliente->mail_cliente."\n".
//                        " ha realizado la consulta nro ". $this->id_carrito)
                ->send();
    }
    public function sendMailFacturacion() {
        $message = Yii::$app->mailer->compose('mailFacturacion', ['carrito' => $this]);



        $message->setFrom('no_reply@texsim.com.ar')
//                ->setBcc('patriciopascolat@gmail.com')
                ->setBcc(['dgvizaq@gmail.com', 'patriciopascolat@gmail.com'])
                ->setTo('pedidos@texsim.com.ar')
                ->setSubject('Se ha realizado el pedido nro ' . $this->id_carrito)
//                ->setTextBody('EL cliente '.$this->cliente->nombre_cliente."\n".
//                        "tel: ".$this->cliente->telefono."\n".
//                        "email: ".$this->cliente->mail_cliente."\n".
//                        " ha realizado la consulta nro ". $this->id_carrito)
                ->send();
    }

}
