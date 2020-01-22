<?php

namespace common\models;

use Yii;
use mikehaertl\wkhtmlto\Pdf as Pdf2;


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
 * @property Vidriera $vidrieraPdf
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
            [['tela_id', 'user_id_pdf', 'vidriera_id','vidriera_pdf'], 'integer'],
            [['tela_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tela::className(), 'targetAttribute' => ['tela_id' => 'id_tela']],
            [['vidriera_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vidriera::className(), 'targetAttribute' => ['vidriera_id' => 'id_vidriera']],
            [['vidriera_pdf'], 'exist', 'skipOnError' => true, 'targetClass' => Vidriera::className(), 'targetAttribute' => ['vidriera_pdf' => 'id_vidriera']],
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
    public function getVidrieraPdf() {
        return $this->hasOne(Vidriera::className(), ['id_vidriera' => 'vidriera_pdf']);
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
    
     public function report($estampados) {
        $vidriera = $estampados;
        /* @var $estampados \common\models\Vidriera */
        foreach ($estampados->itemVidireras as $order => $item) {
            $alldata[] = $item;
        }
        $options = [
            'binary' => Yii::getAlias("@vendor/wkhtmltopdf"),
            'page-size' => 'A4',
//            'header-html' => $this->renderPartial('_pdfHeader'),
//            'footer-html' => $this->renderPartial('_pdfFooter'),
            'no-outline', // option without argument
            'encoding' => 'UTF-8', // option with argument
//            'user-style-sheet' => $cssPath,
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'disable-smart-shrinking',
            'user-style-sheet' => Yii::getAlias("@backend/web/css/pdfstyle.css"),
//            'header-html' => "<h1>Texsim</h1>",
        ];

//        $pdf = new Pdf2(\Yii::getAlias("@backend/views/gallery-image/_report.php"));
//        $model = new PdfReport(['vidriera_id' => $vidriera->id_vidriera, 'user_id_pdf' => Yii::$app->user->getId()]);
        if ($this->load(Yii::$app->request->post())) {
            $this->header = \yii\web\UploadedFile::getInstance($this, 'header');
            $this->header2 = \yii\web\UploadedFile::getInstance($this, 'header2');
            if ($this->header) {
                $this->uploadHeader();
            }
            if ($this->header2) {
                $this->uploadHeader2();
            }
        }
        $pdf = new Pdf2($options);
        if ($this->header) {
            $pages = array_chunk($alldata, 12);
            $pdf->addPage($this->renderPartial('_reportPrimera', ['data' => $pages[0], 'nro' => 1, 'header' => $this->getHeaderName(1)]));
            $alldata = array_slice($alldata, 12);
        }
        $pages = array_chunk($alldata, 16);
        foreach ($pages as $nro => $page) {
            $pdf->addPage($this->renderPartial('_report', ['data' => $page, 'nro' => $nro, 'header2' => $this->getHeaderName(2)]));
        }
//        return $this->renderPartial('_report', ['data' => $pages[0]]);

        if (!$this->nombre_pdf) {
            $date = date("Y-m-d-H-m-i");
            $this->nombre_pdf = trim($model->tela->nombre_tela . "-" . $date);
        }
        if ($this->guardar && $model->save()) {

            $pdf->saveAs(Yii::getAlias("@backend/uploads/pdf-report/" . $this->id_pdf_report . ".pdf"));
        }
        $timestamp = date("Y-m-d-H-m-i");
        if (!$pdf->send("$this->nombre_pdf.pdf")) {
            throw new \Exception('Could not create PDF: ' . $pdf->getError());
        }

        return true;
    }

}
