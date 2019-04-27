<?php

namespace common\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryImage;
use zxbodya\yii2\galleryManager\GalleryBehavior;
/**
 * This is the model class for table "modelo".
 *
 * @property int $id_modelo
 * @property int $disenio_id
 *
 * @property GalleryImage $disenio
 */
class Modelo extends \yii\db\ActiveRecord
{
    
      public function behaviors() {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'modelo',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@backend') . '/web/images/modelo/gallery',
                'url' => Yii::getAlias('@web') . '/../../backend/web/images/modelo/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },

                ]
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['disenio_id'], 'integer'],
//            [['disenio_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['disenio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_modelo' => Yii::t('app', 'Id Modelo'),
            'disenio_id' => Yii::t('app', 'Disenio ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisenio()
    {
        return $this->hasOne(GalleryImage::className(), ['id' => 'disenio_id']);
    }
}
