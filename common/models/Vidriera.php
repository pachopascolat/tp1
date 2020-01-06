<?php

namespace common\models;

use Yii;
use \common\models\base\Vidriera as BaseVidriera;

/**
 * This is the model class for table "vidriera".
 */
class Vidriera extends BaseVidriera
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['categoria_id', 'orden_vidriera'], 'integer'],
            [['nombre'], 'string', 'max' => 128],
            [['estado'], 'string', 'max' => 4]
        ]);
    }
    
    public function addItems($items){
        foreach ($items as $id){
            $item = Articulo::findOne($id);
            $newItem = new ItemVidirera([
                'vidriera_id'=> $this->id_vidriera,
                'articulo_id'=> $item->id_articulo,
                'imagen_id'=>$item->imagen_id,
            ]);
            $newItem->save();
        }
    }
	
}
