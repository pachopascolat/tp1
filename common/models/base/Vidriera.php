<?php

namespace common\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "vidriera".
 *
 * @property integer $id_vidriera
 * @property string $nombre
 * @property integer $estado
 * @property integer $categoria_id
 * @property integer $orden_vidriera
 *
 * @property \common\models\ItemVidirera[] $itemVidireras
 * @property \common\models\PdfReport[] $pdfReports
 * @property \common\models\Categoria $categoria
 */
class Vidriera extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'itemVidireras',
            'categoria'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria_id', 'orden_vidriera'], 'integer'],
            [['nombre'], 'string', 'max' => 128],
//            [['estado'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vidriera';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_vidriera' => 'Id Vidriera',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
            'categoria_id' => 'Categoria ID',
            'orden_vidriera' => 'Orden Vidriera',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemVidireras()
    {
        return $this->hasMany(\common\models\ItemVidirera::className(), ['vidriera_id' => 'id_vidriera'])->orderBy('orden_item_vidriera');
    }
    public function getPdfReports()
    {
        return $this->hasMany(\common\models\PdfReport::className(), ['vidriera_id' => 'id_vidriera']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(\common\models\Categoria::className(), ['id_categoria' => 'categoria_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
//    public function behaviors()
//    {
//        return [
//            'uuid' => [
//                'class' => UUIDBehavior::className(),
//                'column' => 'id_vidriera',
//            ],
//        ];
//    }


    /**
     * @inheritdoc
     * @return \common\models\VidrieraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\VidrieraQuery(get_called_class());
    }
    
    
    
}
