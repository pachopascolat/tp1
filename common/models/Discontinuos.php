<?php

namespace common\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "discontinuos".
 *
 * @property int $id_discontinuos
 * @property int $tela_id
 *
 * @property Tela $tela
 */
class Discontinuos extends \yii\db\ActiveRecord
{
    
    public function behaviors() {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'discontinuos',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@backend') . '/web/images/discontinuos/gallery',
                'url' => Yii::getAlias('@web') . '/../../backend/web/images/discontinuos/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                                        ->copy()
                                        ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
//                    'medium' => function ($img) {
//                        /** @var \Imagine\Image\ImageInterface $img */
//                        $dstSize = $img->getSize();
//                        $maxWidth = 800;
//                        if ($dstSize->getWidth() > $maxWidth) {
//                            $dstSize = $dstSize->widen($maxWidth);
//                        }
//                        return $img
//                                        ->copy()
//                                        ->resize($dstSize);
//                    },
                    'medium' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                                        ->copy()
//                                        ->resize(new \Imagine\Image\Box(500, 500))
                                ;
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
        return 'discontinuos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_id'], 'integer'],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_discontinuos' => Yii::t('app', 'Id Discontinuos'),
            'tela_id' => Yii::t('app', 'Tela ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela()
    {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }
}
