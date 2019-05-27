<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;

/**
 * Description of SecurityController
 *
 * @author pacho
 */
class SecurityController extends BaseSecurityController {

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack(['texsim/hogar']);
        }

//        return $this->render('login', [
//            'model'  => $model,
//            'module' => $this->module,
//        ]);
    }

    public function actionLogout() {
        $event = $this->getUserEvent(\Yii::$app->user->identity);

        $this->trigger(self::EVENT_BEFORE_LOGOUT, $event);

        \Yii::$app->getUser()->logout(false);

        $this->trigger(self::EVENT_AFTER_LOGOUT, $event);

        $session = \Yii::$app->session;
        $session->destroy();
        
        return $this->goBack(['texsim/hogar']);
    }

    //put your code here
}
