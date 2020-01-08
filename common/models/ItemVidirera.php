<?php

namespace common\models;

use Yii;
use noam148\imagemanager\models\ImageManager;

/**
 * This is the model class for table "item_vidirera".
 *
 * @property int $id_item_vidriera
 * @property int|null $articulo_id
 * @property int|null $imagen_id
 * @property int|null $vidriera_id
 * @property int|null $orden_item_vidriera
 * @property int|null $ranking
 *
 * @property ImageManager $imagen
 * @property Articulo $articulo
 * @property Vidriera $vidriera
 */
class ItemVidirera extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'item_vidirera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['articulo_id', 'imagen_id', 'vidriera_id', 'orden_item_vidriera', 'ranking'], 'integer'],
            [['imagen_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImageManager::className(), 'targetAttribute' => ['imagen_id' => 'id']],
            [['articulo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['articulo_id' => 'id_articulo']],
            [['vidriera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vidriera::className(), 'targetAttribute' => ['vidriera_id' => 'id_vidriera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_item_vidriera' => 'Id Item Vidriera',
            'articulo_id' => 'Articulo ID',
            'imagen_id' => 'Imagen ID',
            'vidriera_id' => 'Vidriera ID',
            'orden_item_vidriera' => 'Orden Item Vidriera',
            'ranking' => 'Ranking',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagen() {
        return $this->hasOne(ImageManager::className(), ['id' => 'imagen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo() {
        return $this->hasOne(Articulo::className(), ['id_articulo' => 'articulo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVidriera() {
        return $this->hasOne(Vidriera::className(), ['id_vidriera' => 'vidriera_id']);
    }

    public function getUrl($width=120,$height=120) {
        $url = \Yii::$app->imagemanager->getImagePath($this->imagen_id, $width, $height);
        return $url;
    }
    public function getFullUrl($width=120,$height=120) {
        
        $url =  \yii\helpers\Url::base(true)."/..".Yii::$app->imagemanager->getImagePath($this->imagen_id, $width, $height);
        return $url;
        
    }
    

}
