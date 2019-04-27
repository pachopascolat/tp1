<?php

namespace common\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "estampado".
 *
 * @property int $id_estampado
 * @property string $nombre_estampado
 * @property int $columnas
 * @property int $slides
 * @property int $tela_id
 *
 * @property Tela $tela
 */
class Estampado extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'estampado',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@backend') . '/web/images/estampado/gallery',
                'url' => Yii::getAlias('@web') . '/../../backend/web/images/estampado/gallery',
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
//                    'medium' => function ($img) {
//                        /** @var \Imagine\Image\ImageInterface $img */
//                        $dstSize = $img->getSize();
//                        $maxWidth = 800;
//                        if ($dstSize->getWidth() > $maxWidth) {
//                            $dstSize = $dstSize->widen($maxWidth);
//                        }
//                        return $img
//                                        ->copy()
////                                        ->resize(new \Imagine\Image\Box(500, 500))
//                                ;
//                    },
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'estampado';
    }

    function __construct($config = array()) {
        parent::__construct($config);
        $this->slides = 3;
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['columnas', 'slides', 'tela_id','orden'], 'integer'],
            [['nombre_estampado'], 'string', 'max' => 45],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_estampado' => Yii::t('app', 'Id Estampado'),
            'nombre_estampado' => Yii::t('app', 'Nombre Estampado'),
            'columnas' => Yii::t('app', 'Columnas'),
            'slides' => Yii::t('app', 'Slides'),
            'tela_id' => Yii::t('app', 'Tela ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela() {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }
    public function getImages() {
        return $this->hasMany(\zxbodya\yii2\galleryManager\GalleryImage::className(), ['ownerId' => 'id_estampado']);
    }

//    public function importarDeGrupos() {
//        $estampados = array_chunk($this->tela->grupos, 3);
//        foreach ($estampados as $grupos) {
//            $estampado = new Estampado(['tela_id' => $this->tela_id, 'columnas' => 8]);
//            $estampado->save();
//            foreach ($grupos as $grupo) {
//                $galleryGrupo = $grupo->getBehavior('galleryBehavior')->getImages();
//                foreach ($galleryGrupo as $image) {
//                    $fileName = $grupo->getBehavior('galleryBehavior')->getFilePath($image->id);
//                    $newImg = $estampado->getBehavior('galleryBehavior')->addImage($fileName);
////                $gallery[] = $fileName;
//                    $imageData[$newImg->id] = ['name' => $image->name, 'description' => $image->description];
//                }
//            }
//            $estampado->getBehavior('galleryBehavior')->updateImagesData($imageData);
//        }
//
//
//        return $this->getBehavior('galleryBehavior')->getImages();
//    }

    public function ordenar() {

//        $columnas = $estampado->columnas;
        $desordenados = $this->getBehavior('galleryBehavior')->getImages();
        $columnas = $this->setColumnas();
        $filas = $this->slides;
        $resto = ($columnas * $filas) - count($desordenados);
        for ($i = 0; $i < $resto; $i++) {
            $desordenados[] = null;
        }
        $foo = 0;
        $num = 0;
        foreach ($desordenados as $key => $dis) {
            if ($key % $columnas == 0) {
                $ordenados[$foo] = $dis;
                $index = $foo;
                $foo++;
            } else {
                $index += $filas;
                $ordenados[$index] = $dis;
            }
        }
        ksort($ordenados);
        return $ordenados;
    }

    public function setColumnas() {
        if(count($this->getBehavior('galleryBehavior')->getImages())<5) {
            $this->columnas = 6;
        } else {
            $this->columnas = ceil(count($this->getBehavior('galleryBehavior')->getImages()) / $this->slides);
        }
        
        return $this->columnas;
    }
    
//    public function deleteImages(){
//        $this->getBehavior('galleryBehavior')->before
//    }

}
