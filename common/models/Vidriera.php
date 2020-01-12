<?php

namespace common\models;

use Yii;
use \common\models\base\Vidriera as BaseVidriera;

/**
 * This is the model class for table "vidriera".
 */
class Vidriera extends BaseVidriera {

    const PRINCIPAL = 1;
    const TELAS = 2;
    const PROMOCIONES = 3;
    const PDF = 4;
    const ICONOS = 5;
    const DISCONTINUOS = 6;
    public $categoria_padre;

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_replace_recursive(parent::rules(), [
            [['categoria_id', 'orden_vidriera','categoria_padre'], 'integer'],
            [['nombre'], 'string', 'max' => 128],
//            [['estado'], 'string', 'max' => 4]
        ]);
    }

    public function addItems($items) {
        foreach ($items as $id) {
            $item = Articulo::findOne($id);
            $newItem = new ItemVidirera([
                'vidriera_id' => $this->id_vidriera,
                'articulo_id' => $item->id_articulo,
                'imagen_id' => $item->imagen_id,
            ]);
            $newItem->save();
        }
    }

    public function getCategoriaPadre() {
        return $this->categoria->categoria_padre??$this->categoria_id;
    }

}
