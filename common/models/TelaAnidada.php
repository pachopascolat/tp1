<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tela_anidada".
 *
 * @property int $id_tela_anidada
 * @property int $tela_padre
 * @property int $tela_hija
 * @property int $orden_tela_anidada
 *
 * @property Tela $telaPadre
 * @property Tela $telaHija
 */
class TelaAnidada extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tela_anidada';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_padre', 'tela_hija', 'orden_tela_anidada'], 'integer'],
            [['tela_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_padre' => 'id_tela']],
            [['tela_hija'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_hija' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tela_anidada' => 'Id Tela Anidada',
            'tela_padre' => 'Tela Padre',
            'tela_hija' => 'Tela Hija',
            'orden_tela_anidada' => 'Orden Tela Anidada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelaPadre()
    {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelaHija()
    {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_hija']);
    }
}
