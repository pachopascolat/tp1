<?php

namespace common\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "tela".
 *
 * @property int $id_tela
 * @property string $codigo_tela
 * @property string $nombre_tela
 * @property string $descripcion_tela
 * @property string $descripcion_larga_tela
 * @property string $path_foto_tela
 * @property int $orden_tela
 * @property int $categoria_id
 * @property int $largo
 * @property int $ancho
 *
 * @property Disenio[] $disenios
 * @property Categoria $categoria
 */
class Tela extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'tela',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@backend') . '/web/images/tela/gallery',
                'url' => Yii::getAlias('@web') . '/../../backend/web/images/tela/gallery',
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
                        $maxWidth = 500;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                                        ->copy()
                                        ->resize($dstSize);
                        ;
                    },
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tela';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['descripcion_tela', 'descripcion_larga_tela'], 'safe'],
            [['nombre_tela'], 'required'],
            [['orden_tela', 'categoria_id', 'largo', 'ancho'], 'integer'],
            [['codigo_tela', 'nombre_tela'], 'string', 'max' => 45],
            [['path_foto_tela'], 'string', 'max' => 128],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_tela' => Yii::t('app', 'Id Tela'),
            'codigo_tela' => Yii::t('app', 'Codigo'),
            'nombre_tela' => Yii::t('app', 'Nombre'),
            'descripcion_tela' => Yii::t('app', 'Tipo'),
            'descripcion_larga_tela' => Yii::t('app', 'Descripción'),
            'path_foto_tela' => Yii::t('app', 'Path Foto Tela'),
            'orden_tela' => Yii::t('app', 'Orden Tela'),
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'largo' => Yii::t('app', 'Largo'),
            'ancho' => Yii::t('app', 'Ancho'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisenios() {
        return $this->hasMany(Disenio::className(), ['tela_id' => 'id_tela']);
    }

    public function getLisos() {
        return $this->hasOne(Lisos::className(), ['tela_id' => 'id_tela']);
    }

    public function getDiscontinuos() {
        return $this->hasOne(Discontinuos::className(), ['tela_id' => 'id_tela']);
    }

    public function getEstampados() {
        return $this->hasMany(Estampado::className(), ['tela_id' => 'id_tela'])->orderBy('orden');
    }
    
    public function getGrupos() {
        return $this->hasMany(Grupo::className(), ['tela_id' => 'id_tela'])
//                ->orderBy(['id_grupo' => SORT_DESC])
        ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria() {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'categoria_id']);
    }

    public function getNombreCompleto() {
        return $this->nombre_tela . " " . $this->descripcion_tela;
    }
    
    public function getCantidadDisenios(){
        $cant = 0;
        foreach ($this->estampados as $estampado){
            $cant += count($estampado->getBehavior('galleryBehavior')->getImages());
        }
        return $cant;
    }
    

    public function importarDeGrupos() {
        if ($this->estampados == null) {
            $estampados = array_chunk($this->grupos, 3);
            foreach ($estampados as $grupos) {
                $estampado = new Estampado(['tela_id' => $this->id_tela]);
                $estampado->save();
                $imageData = [];
                foreach ($grupos as $grupo) {
                    $galleryGrupo = $grupo->getBehavior('galleryBehavior')->getImages();
                    foreach ($galleryGrupo as $image) {
                        $fileName = $grupo->getBehavior('galleryBehavior')->getFilePath($image->id);
                        $newImg = $estampado->getBehavior('galleryBehavior')->addImage($fileName);
//                $gallery[] = $fileName;
                        $imageData[$newImg->id] = ['name' => $image->name, 'description' => $image->description];
                    }
                }
                $estampado->getBehavior('galleryBehavior')->updateImagesData($imageData);
            }
        }

//        return $this->getBehavior('galleryBehavior')->getImages();
    }

}
