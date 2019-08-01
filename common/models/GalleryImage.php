<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "gallery_image".
 *
 * @property int $id
 * @property string $type
 * @property string $ownerId
 * @property int $rank
 * @property string $name
 * @property string $description
 *
 * @property ItemCarrito[] $itemCarritos
 * @property Modelo[] $modelos
 */
class GalleryImage extends \yii\db\ActiveRecord {

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'gallery_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv, xls, xlsx', 'maxSize' => 1024 * 1024 * 20, 'checkExtensionByMimeType' => false],
            [['ownerId'], 'required'],
            [['rank'], 'integer'],
            [['oferta', 'agotado'], 'boolean'],
            [['description'], 'string'],
            [['type', 'ownerId', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'ownerId' => Yii::t('app', 'Owner ID'),
            'rank' => Yii::t('app', 'Rank'),
            'name' => Yii::t('app', 'Codigo Color'),
            'description' => Yii::t('app', 'Nombre Color'),
            'imageFile' => 'Archivo Excel'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCarritos() {
        return $this->hasMany(ItemCarrito::className(), ['disenio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//   public function getModelo() {
//        return $this->hasOne(Modelo::className(), ['id_modelo' => 'ownerId']);
//    }
    public function getLiso() {
        return $this->hasOne(Lisos::className(), ['id_lisos' => 'ownerId']);
    }

    public function getEstampados() {
        return $this->hasMany(Estampado::className(), ['id_estampado' => 'ownerId']);
    }

    public function getGaleria() {
        return $this->hasOne(Galeria::className(), ['id_galeria' => 'ownerId']);
    }

    public function getGaleriaModelos() {
        return $this->hasOne(Galeria::className(), ['color_id' => 'id'])
//                ->where(['color_id'=>'id'])
//                ->where(['tipo_galeria'=> Galeria::MODEL0])
        ;
    }

    public function getDiscontinuo() {
        return $this->hasOne(Discontinuos::className(), ['id_discontinuos' => 'ownerId']);
    }

    public function getTipoDisenio() {
        $img = \common\models\GalleryImage::findOne($this->id);
        $type = $img->type;
        switch ($type) {
            case 'tela':
                $disenio = \common\models\Tela::findOne($img->ownerId);
                break;
            case 'lisos':
                $disenio = \common\models\Lisos::findOne($img->ownerId);
                break;
            case 'discontinuos':
                $disenio = \common\models\Discontinuos::findOne($img->ownerId);
                break;
            case 'estampado':
                $disenio = \common\models\Estampado::findOne($img->ownerId);
                break;
            case 'galeria':
                $disenio = \common\models\Galeria::findOne($img->ownerId);
                break;
            case 'grupo':
                $disenio = \common\models\Grupo::findOne($img->ownerId);
                break;
            case 'modelo':
                $disenio = \common\models\Modelo::findOne([$img->ownerId]);
//                $modelimg = GalleryImage::findOne($modelo->disenio_id);
//                $disenio = \common\models\Estampado::findOne($modelimg->ownerId);
                break;
            default:
                break;
        }
        return $disenio;
    }

    public function getTela() {
        $tela = new Tela();
        if ($this->type == 'modelo') {
            $modelo = Modelo::findOne($this->ownerId);
            if ($modelo != null) {
                $modelimg = GalleryImage::findOne($modelo->disenio_id);
                $disenio = \common\models\Estampado::findOne($modelimg->ownerId);
                $tela = \common\models\Tela::findOne($disenio->tela_id);
            }
        } elseif ($this->type == 'tela') {
            return $this->getTipoDisenio();
        } else {
            if ($this->getTipoDisenio() != null) {
                $tela_id = $this->getTipoDisenio()->tela_id;
                $tela = \common\models\Tela::findOne($tela_id);
            }
        }
        return $tela;
    }

    public function getUrl($version = 'original') {

//        $domain = parse_url('http://google.com', PHP_URL_HOST);
        $url = trim(\yii\helpers\Url::home(true),"admin/") . "/backend/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $url;
    }

    public function getPath($version = 'original') {

        $path = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $path;
    }

    public function getNombreTela() {
        if ($this->galeria)
            return $this->galeria->tela->nombre_tela;
    }

    public function getTelaId() {
        return $this->getTela()->id_tela;
    }

    public function upload() {
        if ($this->validate(['imageFile'])) {
            $this->imageFile->saveAs(\Yii::getAlias("@webroot/../stock/") . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function agotarStock(){
       return  \Yii::$app->db->createCommand("UPDATE gallery_image SET agotado=1")->execute();
    }
    
    public function castearName(){
        $images = $this->find()->all();
        foreach ($images as $image){
            $image->name = ltrim($image->name, '0');
            $image->save();
        }
    }
}
