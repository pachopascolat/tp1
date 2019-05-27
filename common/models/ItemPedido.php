<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_pedido".
 *
 * @property int $id_item_pedido
 * @property int $disenio_id
 * @property int $cantidad
 * @property double $precio
 * @property int $pedido_id
 *
 * @property GalleryImage $disenio
 * @property ItemPedido $pedido
 * @property ItemPedido[] $itemPedidos
 */
class ItemPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disenio_id', 'cantidad', 'pedido_id'], 'integer'],
            [['precio'], 'number'],
            [['disenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['disenio_id' => 'id']],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemPedido::className(), 'targetAttribute' => ['pedido_id' => 'id_item_pedido']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item_pedido' => 'Id Item Pedido',
            'disenio_id' => 'Disenio ID',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'pedido_id' => 'Pedido ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisenio()
    {
        return $this->hasOne(GalleryImage::className(), ['id' => 'disenio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedido()
    {
        return $this->hasOne(ItemPedido::className(), ['id_item_pedido' => 'pedido_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPedidos()
    {
        return $this->hasMany(ItemPedido::className(), ['pedido_id' => 'id_item_pedido']);
    }
}
