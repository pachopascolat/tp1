<?php

namespace common\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "galeria".
 *
 * @property int $id_galeria
 * @property string $nombre_galeria
 * @property int $columnas
 * @property int $slides
 * @property int $tela_id
 * @property int $orden
 * @property int $tipo_galeria
 * @property int $color_id
 *
 * @property Tela $tela
 * @property GalleryImage $color
 */
class Galeria extends \yii\db\ActiveRecord
{
    const LISO = 2;
    const MODEL0 = 3;
    const DISENIO = 1;
    const DISCONTINUO = 4;
    /**
     * {@inheritdoc}
     */
    
     public function behaviors() {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'galeria',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@backend') . '/web/images/galeria/gallery',
                'url' => \yii\helpers\Url::home(true).'../backend/web/images/galeria/gallery',
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
    
    public static function tableName()
    {
        return 'galeria';
    }

    function __construct($config = array()) {
        parent::__construct($config);
        $this->slides = 3;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_id'], 'required'],
            [['columnas', 'slides', 'tela_id', 'orden', 'tipo_galeria', 'color_id'], 'integer'],
            [['nombre_galeria'], 'string', 'max' => 45],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_galeria' => 'Id Galeria',
            'nombre_galeria' => 'Nombre Galeria',
            'columnas' => 'Columnas',
            'slides' => 'Slides',
            'tela_id' => 'Tela ID',
            'orden' => 'Orden',
            'tipo_galeria' => 'Tipo Galeria',
            'color_id' => 'Color ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela()
    {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(GalleryImage::className(), ['id' => 'color_id']);
    }
    
//    public function getModelos() {
//        return $this->hasMany(GalleryImage::className(), ['color_id' => 'id'])
////                ->where(['color_id'=>'id'])
////                ->where(['tipo_galeria'=> Galeria::MODEL0])
//        ;
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
    
    public function getImages(){
        
    }
    
}
