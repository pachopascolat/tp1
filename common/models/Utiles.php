<?php

namespace common\models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utiles
 *
 * @author pacho
 */
class Utiles {

    //put your code here

    public static function armarGridRegular($items, $columnas): array {
        $itemsArranged = [];
        if (count($items) % $columnas != 0) {
            $resto = $columnas - count($items) % $columnas;
            for ($i = 0; $i < $resto; $i++) {
                $items[] = null;
            }
        }
        $itemsArranged = array_chunk($items, $columnas);
        return $itemsArranged;
    }

    public function normalizarGrid($items, $columns) {
        $itemsNormalizados = [];
        $total = count($items);
        if ($total < ($columns*2)) {
            $resto = ($columns*2) - $total;
            for ($j = 0; $j < $resto; $j++) {
                $itemsNormalizados[] = null;
            }
        }
        return $itemsNormalizados;
    }

}
