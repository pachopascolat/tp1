<?php

namespace common\models;

use Yii;
use noam148\imagemanager\models\ImageManager;

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

}
