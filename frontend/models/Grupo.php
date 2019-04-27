<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property int $id_grupo
 * @property string $nombre
 * @property int $tela_id
 *
 * @property Tela $tela
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_grupo' => Yii::t('app', 'Id Grupo'),
            'nombre' => Yii::t('app', 'Nombre'),
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
