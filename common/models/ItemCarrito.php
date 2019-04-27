<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_carrito".
 *
 * @property int $id_item_carrito
 * @property int $disenio_id
 *
 * @property GalleryImage $disenio
 */
class ItemCarrito extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'item_carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['disenio_id'], 'integer'],
            [['disenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['disenio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_item_carrito' => Yii::t('app', 'Id Item Carrito'),
            'disenio_id' => Yii::t('app', 'Disenio ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisenio() {
        return $this->hasOne(GalleryImage::className(), ['id' => 'disenio_id']);
    }

    public function getCarrito() {
        return $this->hasOne(Carrito::className(), ['id_carrito' => 'carrito_id']);
    }

    public function getUrl($version = 'original') {
        $url = '';
        $img = GalleryImage::findOne($this->disenio_id);
        if ($img != null) {
            $disenio = $img->getTipoDisenio();
            if ($disenio != null) {
                $url = $disenio->getBehavior('galleryBehavior')->getUrl($this->disenio_id, $version);
            }
        }
        return $url;
    }

    public function getNombreTela() {
        $img = GalleryImage::findOne($this->disenio_id);
        if ($img != null) {
            return $img->getTela()->getNombreCompleto();
        }
    }

    public function getCodigo() {
        $img = GalleryImage::findOne($this->disenio_id);
        if ($img != null) {
            return $img->name;
        }
    }
    
    public function getTipoTela(){
        $tipo = $this->disenio;
        switch ($tipo->type) {
            case 'lisos':
                return "Liso";
                break;
            case 'discontinuos':
                return "Discontinuo";
                break;
            default:
                return "";
                break;
        }
    }
    
    public function getCodigoTela(){
                $img = GalleryImage::findOne($this->disenio_id);
        if ($img != null) {
            return $img->getTela()->codigo_tela;
        }
    }

}
