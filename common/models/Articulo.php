<?php

namespace common\models;

use Yii;
use noam148\imagemanager\models\ImageManager;
use yii\imagine\Image;


/**
 * This is the model class for table "articulo".
 *
 * @property int $id_articulo
 * @property string|null $nombre_color
 * @property string|null $nombre_articulo
 * @property int|null $tela_id
 * @property int|null $codigo_color
 * @property int|null $imagen_id
 * @property int|null $existencia
 * @property int|null $estado
 *
 * @property Tela $tela
 * @property ImageManager $imagen
 */
class Articulo extends \yii\db\ActiveRecord {

    public $imageFile;
    public $_codigo_tela;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tela_id', 'codigo_color', 'imagen_id', 'existencia', 'estado'], 'integer'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv, xls, xlsx', 'maxSize' => 1024 * 1024 * 20, 'checkExtensionByMimeType' => false],
            [['nombre_color', 'nombre_articulo'], 'string', 'max' => 45],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
            [['imagen_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImageManager::className(), 'targetAttribute' => ['imagen_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_articulo' => 'Id Articulo',
            'nombre' => 'Nombre',
            'tela_id' => 'Tela ID',
            'codigo_color' => 'Codigo Color',
            'imagen_id' => 'Imagen ID',
            'existencia' => 'Existencia',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela() {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagen() {
        return $this->hasOne(ImageManager::className(), ['id' => 'imagen_id']);
    }

    public function upload() {
        if ($this->validate(['imageFile'])) {
            $this->imageFile->saveAs(\Yii::getAlias("@webroot/../stock/") . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function agotarStock() {
        return \Yii::$app->db->createCommand("UPDATE articulo SET existencia=0")->execute();
    }

    public function getOldImage() {
        $imageList = [];
        $galleryImage = GalleryImage::find()->joinWith('galeria')->where(['name' => $this->codigo_color,'tela_id'=> $this->tela_id])->all();
        foreach ($galleryImage as $image) {
            /* @var $image GalleryImage */
//            if ($image->getTela() && $image->getTela()->codigo_tela == $this->tela->codigo_tela) {
                $imageList[] = $image;
//            }
        }
        return $imageList;
    }

    public function migrarImagen($galleryImage) {
//        $galleryImage = $this->getOldImage();
        if(!$galleryImage){
            return false;
        }
        $sTempFile = $galleryImage->getPath();
        $tela = $galleryImage->getTela();

        $cod_tela = $tela->codigo_tela ?? 'sinTela';
        $cod_color = $galleryImage->name;
        $name = $galleryImage->description;
        $nameFile = "$cod_tela-$cod_color-$name";


        $bSuccess = false;


        $sMediaPath = \Yii::$app->imagemanager->mediaPath;
        //create the folder
        \yii\helpers\BaseFileHelper::createDirectory($sMediaPath);

        //check file isset
        if (true) {
            //collect variables
            $sFileName = dirname($sTempFile);
            $sFileExtension = pathinfo($sTempFile, PATHINFO_EXTENSION) ?? 'jpg';
//                $iErrorCode = $sTempFile['error'];
            //if uploaded file has no error code  than continue;
            if (file_exists($sTempFile)) {
                //create a file record
                $model = new ImageManager();
//                $model->fileName = str_replace("_", "-", $sFileName);
                $model->fileName = $nameFile . "." . $sFileExtension;
                $model->fileHash = Yii::$app->getSecurity()->generateRandomString(32);
                if ($tela) {
                    $articulo = $this;
                    $articulo->codigo_color = intval($galleryImage->name);
                    $articulo->nombre_color = $galleryImage->description;
                    $articulo->imagen_id = $model->id;
                    if ($model->validate() && $articulo->validate()) {
                        $model->save(false);
                        $articulo->imagen_id = $model->id;
                        $articulo->save(false);
                        //move file to dir
                        $sSaveFileName = $model->id . "_" . $model->fileHash . "." . $sFileExtension;
                        //move_uploaded_file($sTempFile, $sMediaPath."/".$sFileName);
                        //save with Imagine class
                        Image::getImagine()->open($sTempFile)->save($sMediaPath . "/" . $sSaveFileName);
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }

        return true;




        //echo return json encoded
//        return $this->redirect('ver-stock');
    }

    public function getFrontFullUrl($width=120,$height=120) {

        $url =  \yii\helpers\Url::base(true).Yii::$app->imagemanager->getImagePath($this->imagen_id, $width, $height);
        return $url;

    }

    public function getCodigoTela(){
        return $this->tela->codigo_tela;
    }

}
