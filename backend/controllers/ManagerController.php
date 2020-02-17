<?php

namespace backend\controllers;


use noam148\imagemanager\controllers\ManagerController as ManagerBase;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerController extends ManagerBase {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['stockManager'],
                    ],
                ],
            ],
        ];
    }

}
