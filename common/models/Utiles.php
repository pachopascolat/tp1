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
        $j=0;
            while (count($items) % ($columnas) != 0) {   
//                $items[] = $items[$j];
                $items[] = null;
                $j++;
            }
//        if (count($items) % $columnas != 0) {
//            while(count($items)<$columnas)
//            for ($i = 0; $i < $resto; $i++) {
//                $items[] = null;
//            }
//        }
        $itemsArranged = array_chunk($items, $columnas);
        return $itemsArranged;
    }

//    public function normalizarGrid($items, $columns) {
//        $itemsNormalizados = [];
//        $total = count($items);
//        while($total < ($columns *2)){
//            $itemsNormalizados[] = null;
//        }
//        if ($total < ($columns * 2)) {
//            $resto = ($columns * 2) - $total;
//            for ($j = 0; $j < $resto; $j++) {
//                $itemsNormalizados[] = null;
//            }
//        }
//        return $itemsNormalizados;
//    }

}
