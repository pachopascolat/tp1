<?php
//$modelList = [];
//$imageList = [];
//                                    $name = $dis->name;
//                                    $url = $dis->getUrl('original');
//                                    $modelList[] = ['name' => $name, 'url' => $url];
$modelos = \common\models\Modelo::findone(['disenio_id' => $disenio->id]);
if ($modelos != null) {
    $imageList = $modelos->getBehavior('galleryBehavior')->getImages();
    foreach ($imageList as $dis) :
        ?>
        <div data-id="<?= $dis->id ?>" data-code="<?= $dis->name?>" id="modal-img<?= $dis->id ?>" style="background: center center  url('<?= $dis->getUrl('original') ?>') no-repeat; background-size: cover;" class="detail-full-item-modal"></div>
        <?php
    endforeach;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

