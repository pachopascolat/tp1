<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Galeria;

/**
 * GaleriaSearch represents the model behind the search form of `common\models\Galeria`.
 */
class GaleriaSearch extends Galeria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_galeria', 'columnas', 'slides', 'tela_id', 'orden', 'tipo_galeria', 'color_id'], 'integer'],
            [['nombre_galeria'], 'safe'],
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
        $query = Galeria::find();

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
            'id_galeria' => $this->id_galeria,
            'columnas' => $this->columnas,
            'slides' => $this->slides,
            'tela_id' => $this->tela_id,
            'orden' => $this->orden,
            'tipo_galeria' => $this->tipo_galeria,
            'color_id' => $this->color_id,
        ]);

        $query->andFilterWhere(['like', 'nombre_galeria', $this->nombre_galeria]);

        return $dataProvider;
    }
}
