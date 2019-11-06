<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_pdf_report".
 *
 * @property int $id_item_pdf_report
 * @property int $pdf_report_id
 * @property int $image_id
 * @property int $ranking
 *
 * @property PdfReport $pdfReport
 * @property GalleryImage $image
 */
class ItemPdfReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_pdf_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pdf_report_id', 'image_id', 'ranking'], 'integer'],
            [['pdf_report_id'], 'exist', 'skipOnError' => true, 'targetClass' => PdfReport::className(), 'targetAttribute' => ['pdf_report_id' => 'id_pdf_report']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item_pdf_report' => 'Id Item Pdf Report',
            'pdf_report_id' => 'Pdf Report ID',
            'image_id' => 'Image ID',
            'ranking' => 'Ranking',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPdfReport()
    {
        return $this->hasOne(PdfReport::className(), ['id_pdf_report' => 'pdf_report_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(GalleryImage::className(), ['id' => 'image_id']);
    }
}
