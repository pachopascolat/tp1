<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carrito;

/**
 * CarritoSearch represents the model behind the search form of `common\models\Carrito`.
 */
class CarritoSearch extends Carrito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_carrito', 'cliente_id'], 'integer'],
            [['timestamp', 'confirmado','vendedor_id'], 'safe'],
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
        $query = Carrito::find();
        $query->orderBy('timestamp DESC');
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
            'id_carrito' => $this->id_carrito,
            'cliente_id' => $this->cliente_id,
            'timestamp' => $this->timestamp,
            'confirmado' => $this->confirmado,
            'para_facturar' => $this->para_facturar,
        ]);

//        $query->andFilterWhere(['like', 'confirmado', $this->confirmado]);

        return $dataProvider;
    }
}
