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
    
	
}
