<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pdf_report".
 *
 * @property int $id_pdf_report
 * @property string $timestamp_pdf
 * @property int $tela_id
 * @property int $user_id_pdf
 * @property string $nombre_pdf
 * 
 *
 * @property Tela $tela
 * @property Vidriera $vidriera
 * @property User $userIdPdf
 */
class PdfReport extends \yii\db\ActiveRecord {

    public $header;
    public $header2;
    public $imageFile;
    public $guardar;

    function __construct($config = array()) {
        parent::__construct($config);
        $this->header = $this->getHeaderName(1);
        $this->header2 = $this->getHeaderName(2);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pdf_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['imageFile', 'header', 'header2'], 'file', 'skipOnEmpty' => true,
//                'extensions' => 'png, jpg,jpeg','JPG','JPEG','PNG'
            ],
            [['timestamp_pdf', 'guardar', 'header', 'header2'], 'safe'],
            [['nombre_pdf'], 'string'],
            [['nombre_pdf'], 'required'],
            [['tela_id', 'user_id_pdf', 'vidriera_id'], 'integer'],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
            [['user_id_pdf'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_pdf' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_pdf_report' => 'Id Pdf Report',
            'timestamp_pdf' => 'Timestamp Pdf',
            'tela_id' => 'Tela ID',
            'user_id_pdf' => 'User Id Pdf',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/pdf/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function uploadHeader() {
        if ($this->validate()) {
            $path = trim($this->header->baseName . "." . $this->header->extension);
            $this->header->saveAs(Yii::getAlias("@backend/web/pdf/headers/$path"));
            return true;
        } else {
            return false;
        }
    }

    public function uploadHeader2() {
        if ($this->validate()) {
            $path = trim($this->header2->baseName . "." . $this->header2->extension);
            $this->header2->saveAs(Yii::getAlias("@backend/web/pdf/headers/$path"));
            return true;
        } else {
            return false;
        }
    }

    function getHeaderUrl() {
        $path = trim($this->header->baseName . "." . $this->header->extension);
        $url = Yii::getAlias("@web/../backend/web/pdf/headers/$path");
        return $url;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTela() {
        return $this->hasOne(Tela::className(), ['id_tela' => 'tela_id']);
    }

    public function getVidriera() {
        return $this->hasOne(Vidriera::className(), ['id_vidriera' => 'vidriera_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdPdf() {
        return $this->hasOne(User::className(), ['id' => 'user_id_pdf']);
    }

    function getHeaderName($number = 1) {
        if ($number == 1) {
            if ($this->header) {
                return $this->header->baseName . "." . $this->header->extension;
            }
            return "header1.jpg";
        } else {
            if ($this->header2) {
                return $this->header2->baseName . "." . $this->header2->extension;
            }
            return "header2.jpg";
        }
    }

}
