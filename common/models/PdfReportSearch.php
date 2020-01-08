<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PdfReport;

/**
 * PdfReportSearch represents the model behind the search form of `common\models\PdfReport`.
 */
class PdfReportSearch extends PdfReport {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_pdf_report', 'tela_id', 'user_id_pdf'], 'integer'],
            [['timestamp_pdf', 'nombre_pdf'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = PdfReport::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['timestamp_pdf' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pdf_report' => $this->id_pdf_report,
            'timestamp_pdf' => $this->timestamp_pdf,
            
            'tela_id' => $this->tela_id,
            'user_id_pdf' => $this->user_id_pdf,
        ]);

        $query->andFilterWhere([
            'like','nombre_pdf',$this->nombre_pdf
        ]);

        return $dataProvider;
    }

}
