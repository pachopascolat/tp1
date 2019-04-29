<?php

namespace common\models;

use Yii;

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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
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
   public function getModelo() {
        return $this->hasOne(Modelo::className(), ['id_modelo' => 'ownerId']);
    }
    public function getLiso() {
        return $this->hasOne(Lisos::className(), ['id_lisos' => 'ownerId']);
    }
    public function getEstampados() {
        return $this->hasMany(Estampado::className(), ['id_estampado' => 'ownerId']);
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

        $url = \yii\helpers\Url::home(true)."../backend/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $url;
    }
    public function getPath($version = 'original') {

        $path = \Yii::getAlias("@backend")."/web/images/$this->type/gallery/$this->ownerId/$this->id/$version.jpg";
        return $path;
    }

    public function getNombreTela() {
        return $this->getTela()->nombre_tela;
    }

    public function getTelaId() {
        return $this->getTela()->nombre_tela;
    }
}
