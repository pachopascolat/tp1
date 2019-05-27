<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedidos".
 *
 * @property int $id_pedido
 * @property int $vendedor_id
 * @property int $cliente_id
 * @property string $timestamp
 * @property string $observaciones
 * @property string $direccion_envio
 *
 * @property User $vendedor
 * @property ClienteAd $cliente
 */
class Pedidos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendedor_id', 'cliente_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['observaciones'], 'string'],
            [['direccion_envio'], 'string', 'max' => 128],
            [['vendedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['vendedor_id' => 'id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClienteAd::className(), 'targetAttribute' => ['cliente_id' => 'id_cliente_ad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pedido' => 'Id Pedido',
            'vendedor_id' => 'Vendedor ID',
            'cliente_id' => 'Cliente ID',
            'timestamp' => 'Timestamp',
            'observaciones' => 'Observaciones',
            'direccion_envio' => 'Direccion Envio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendedor()
    {
        return $this->hasOne(User::className(), ['id' => 'vendedor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(ClienteAd::className(), ['id_cliente_ad' => 'cliente_id']);
    }
}
