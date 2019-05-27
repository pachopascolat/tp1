<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cliente_ad".
 *
 * @property int $id_cliente_ad
 * @property int $nro_cliente
 * @property int $cuit
 * @property string $nombre_apellido
 * @property string $telefono
 * @property string $email
 * @property string $direccion_envio
 *
 * @property Pedidos[] $pedidos
 */
class ClienteAd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente_ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nro_cliente', 'cuit'], 'integer'],
            [['nombre_apellido', 'telefono', 'email', 'direccion_envio'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cliente_ad' => 'Id Cliente Ad',
            'nro_cliente' => 'Nro Cliente',
            'cuit' => 'Cuit',
            'nombre_apellido' => 'Nombre Apellido',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'direccion_envio' => 'Direccion Envio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedidos::className(), ['cliente_id' => 'id_cliente_ad']);
    }
}
