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
 * @property int $agotado
 * @property int $estado
 *
 * @property ItemCarrito[] $itemCarritos
 * @property Modelo[] $modelos
 * @property Galeria $galeria
 * 
 */
class GalleryImage extends \yii\db\ActiveRecord {

    public $imageFile;
    public $pdf_rank;

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
            [['rank','pdf-rank'], 'integer'],
            [['estado',], 'safe'],
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
                        ->where(['tipo_galeria' => Galeria::MODEL0])
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

//    public function getTela() {
//        $tela = new Tela();
//        if ($this->type == 'modelo') {
//            $modelo = Modelo::findOne($this->ownerId);
//            if ($modelo != null) {
//                $modelimg = GalleryImage::findOne($modelo->disenio_id);
//                $disenio = \common\models\Estampado::findOne($modelimg->ownerId);
//                $tela = \common\models\Tela::findOne($disenio->tela_id);
//            }
//        } elseif ($this->type == 'tela') {
//            return $this->getTipoDisenio();
//        } else {
//            if ($this->getTipoDisenio() != null) {
//                $tela_id = $this->getTipoDisenio()->tela_id;
//                $tela = \common\models\Tela::findOne($tela_id);
//            }
//        }
//        return $tela;
//    }

    public function getUrl($version = 'original') {

//        $domain = parse_url('http://google.com', PHP_URL_HOST);
        $url = trim(\yii\helpers\Url::home(true), "admin/") . "/backend/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $url;
    }

    public function getPath($version = 'original') {

        $path = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $path;
    }

    public function getFolder() {

        $path = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$this->ownerId/$this->id";
        return $path;
    }

    public function getFatherFolder() {

        $path = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$this->ownerId";
        return $path;
    }

    public function renameFatherFolder($new) {

        $path = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$this->ownerId";
        $newPath = \Yii::getAlias("@backend") . "/web/images/$this->type/gallery/$new";
        rename($path, $newPath);
        return $newPath;
    }

    public function getNombreTela() {
        if ($this->galeria)
            return $this->galeria->tela->nombre_tela;
    }

    public function getTela() {
        if ($this->galeria)
            return $this->galeria->tela;
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

    public function agotarStock() {
        return \Yii::$app->db->createCommand("UPDATE gallery_image SET agotado=1")->execute();
    }

    public function castearName() {
        $images = $this->find()->all();
        foreach ($images as $image) {
            $image->name = ltrim($image->name, '0');
            $image->save();
        }
    }

    function hayQueMostrarlo() {
        return $this->estado || !$this->agotado;
    }

    function tieneModelos() {
        if ($this->galeriaModelos) {
            foreach ($this->galeriaModelos->getGalleryImages2() as $image) {
                if (!$image->agotado || $image->estado)
                    return true;
            }
        }
        return false;
    }

    function getCantidadModelos() {
        $galeria = Galeria::findOne(['color_id' => $this->id]);
        $cant = 0;
        if ($galeria) {
            $images = $galeria->getBehavior('galleryBehavior')->getImages();
            $cant = count($images);
//            $url = yii\helpers\Url::to(['/galeria/ver-disenios', 'tela_id' => $model->galeria->tela_id, 'GalleryImageSearch[]', 'GalleryImageSearch[name]' => $model->name ?? '']);
//            return Html::a($cant, $url);
        }
        return $cant;
    }

    function getModelosVisibles() {
        $modelos = GalleryImage::find()->joinWith('galeria')->where([
                            'color_id' => 'id'
                        ])->andWhere(['agotado' => FALSE])
                        ->orWhere(['estado' => true])->all();
        return $modelos;
    }

    function convertirEnPadre() {
        $padre = GalleryImage::findOne($this->galeria->color_id);
        $transaction = $padre->getDb()->beginTransaction();
        try {

            //copia de seguridad de la carpeta
            $this->recurse_copy($padre->getFolder(), $padre->getFolder() . ".old");
            $this->recurse_copy($this->getFolder(), $this->getFolder() . ".old");


            $this->recurse_copy($this->getFolder(), $padre->getFolder());
            $this->recurse_copy($padre->getFolder() . ".old", $this->getFolder());



            $newPadre = new GalleryImage();
            $newPadre->setAttributes($padre->getAttributes());

            $padre->setAttributes($this->getAttributes());
            $padre->ownerId = $newPadre->ownerId;

            $ownerId_hijo = $this->ownerId;
            $this->setAttributes($newPadre->getAttributes());
            $this->ownerId = $ownerId_hijo;

            $padre->update();
            $this->update();


            $transaction->commit();
            return true;
        } catch (Exception $exc) {
            $this->recurse_copy($padre->getFolder() . ".old", $padre->getFolder());
            $this->recurse_copy($this->getFolder() . ".old", $this->getFolder());
            $transaction->rollBack();
            return false;
        }
    }

    private function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

}
