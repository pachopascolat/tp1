<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria_tela".
 *
 * @property int $id_categoria_tela
 * @property int $tela_id
 * @property int $categoria_id
 * @property int $orden
 *
 * @property Categoria $categoria
 * @property Tela $tela
 */
class CategoriaTela extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria_tela';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tela_id', 'categoria_id', 'orden'], 'integer'],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id_categoria']],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria_tela' => 'Id Categoria Tela',
            'tela_id' => 'Tela ID',
            'categoria_id' => 'Categoria ID',
            'orden' => 'Orden',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela()
    {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }
}
