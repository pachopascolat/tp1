<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Estampado;

/**
 * EstampadoSearch represents the model behind the search form of `common\models\Estampado`.
 */
class EstampadoSearch extends Estampado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estampado', 'columnas', 'slides', 'tela_id'], 'integer'],
            [['nombre_estampado'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Estampado::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_estampado' => $this->id_estampado,
            'columnas' => $this->columnas,
            'slides' => $this->slides,
            'tela_id' => $this->tela_id,
        ]);

        $query->andFilterWhere(['like', 'nombre_estampado', $this->nombre_estampado]);

        return $dataProvider;
    }
}
