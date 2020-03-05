<?php

namespace common\models;

use Yii;
use codeonyii\yii2validators\AtLeastValidator;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id_cliente
 * @property string $nombre_cliente
 * @property string $telefono
 * @property string $mail_cliente
 *
 * @property Carrito[] $carritos
 */
class Cliente extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre_cliente'], 'required',
                'message' => "Por favor complete su Nombre"
            ],
            [['mail_cliente'], 'email'],
            [['cuit', 'nro_cliente'], 'integer'],
            [['nro_cliente', 'cuit'], 'unique'],
            [['direccion_envio', 'agendado'], 'safe'],
            ['telefono', AtLeastValidator::className(), 'in' => ['telefono', 'mail_cliente']],
//            ['telefono', 'either', 'skipOnEmpty' => false, 'params' => ['other' => 'mail_cliente']],
//            [['telefono'], 'filledContacts', 'skipOnError' => true, 'skipOnEmpty' => false],
//            [['telefono'], 'required'],
            [['nombre_cliente', 'telefono', 'mail_cliente'], 'string', 'max' => 128],
        ];
    }

    public function filledContacts($attribute, $params, $validator) {

        if (!$this->hasErrors('mail_cliente') && !$this->hasErrors('telefono')) { // If any contact field has validation errors, then don't show a message.
            if (empty($this->mail_cliente) && empty($this->telefono))
                $validator->addError($this, $attribute, "Uno de los campos Telefono o Email debe ser completado.");
//                $this->addError('mail_cliente', "Uno de los campos Telefono o Email debe ser completado.");
        }
    }

    public function either($attribute_name, $params) {
        /**
         * validate actula attribute
         */
        if (!empty($this->$attribute_name)) {
            return;
        }

        if (!is_array($params['other'])) {
            $params['other'] = [$params['other']];
        }

        /**
         * validate other attributes
         */
        foreach ($params['other'] as $field) {
            if (!empty($this->$field)) {
                return;
            }
        }

        /**
         * get attributes labels
         */
        $fieldsLabels = [$this->getAttributeLabel($attribute_name)];
        foreach ($params['other'] as $field) {
            $fieldsLabels[] = $this->getAttributeLabel($field);
        }

        $this->addError($attribute_name, Yii::t('user', "Uno de los campos Telefono o Email debe ser completado."));
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_cliente' => Yii::t('app', 'Id Cliente'),
            'nombre_cliente' => Yii::t('app', 'Nombre o Razón Social'),
            'telefono' => Yii::t('app', 'Telefono'),
            'mail_cliente' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarritos() {
        return $this->hasMany(Carrito::className(), ['cliente_id' => 'id_cliente']);
    }

}
