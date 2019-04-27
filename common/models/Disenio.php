<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "disenio".
 *
 * @property int $id_disenio
 * @property string $nombre_disenio
 * @property string $descripcion_disenio
 * @property string $orden_disenio
 * @property int $tela_id
 * @property string $path_foto_disenio
 * @property int $stock
 *
 * @property Tela $tela
 */
class Disenio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disenio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_id', 'stock'], 'integer'],
            [['nombre_disenio', 'descripcion_disenio', 'orden_disenio'], 'string', 'max' => 45],
            [['path_foto_disenio'], 'string', 'max' => 128],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_disenio' => Yii::t('app', 'Id Disenio'),
            'nombre_disenio' => Yii::t('app', 'Nombre Disenio'),
            'descripcion_disenio' => Yii::t('app', 'Descripcion Disenio'),
            'orden_disenio' => Yii::t('app', 'Orden Disenio'),
            'tela_id' => Yii::t('app', 'Tela ID'),
            'path_foto_disenio' => Yii::t('app', 'Path Foto Disenio'),
            'stock' => Yii::t('app', 'Stock'),
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
