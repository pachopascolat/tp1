<?php

namespace common\models;

use Yii;
use codeonyii\yii2validators\AtLeastValidator;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id_cliente
 * @property string $nombre_cliente
 * @property int $nro_cliente
 * @property int $cuit
 * @property string $telefono
 * @property string $mail_cliente
 *
 * @property Carrito[] $carritos
 */
class Cliente extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre_cliente'], 'required',
                'message' => "Por favor complete su Nombre"
            ],
            [['mail_cliente'], 'email'],
            [['cuit', 'nro_cliente'], 'integer'],
            ['nro_cliente', 'unique'],
//            [['cuit','nro_cliente'],'unique'],
            [['direccion_envio', 'agendado'], 'safe'],
            ['telefono', AtLeastValidator::className(), 'in' => ['telefono', 'mail_cliente']],
//            ['telefono', 'either', 'skipOnEmpty' => false, 'params' => ['other' => 'mail_cliente']],
//            [['telefono'], 'filledContacts', 'skipOnError' => true, 'skipOnEmpty' => false],
//            [['telefono'], 'required'],
            [['nombre_cliente', 'telefono', 'mail_cliente'], 'string', 'max' => 128],
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_cliente' => Yii::t('app', 'Id Cliente'),
            'nombre_cliente' => Yii::t('app', 'Nombre o Razón Social'),
            'cuit' => Yii::t('app', 'Cuit'),
            'nro_cliente' => Yii::t('app', 'Numero Cliente'),
            
            'telefono' => Yii::t('app', 'Telefono'),
            'mail_cliente' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarritos() {
        return $this->hasMany(Carrito::className(), ['cliente_id' => 'id_cliente']);
    }

}
