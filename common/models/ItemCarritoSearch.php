<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ItemCarrito;

/**
 * ItemCarritoSearch represents the model behind the search form of `common\models\ItemCarrito`.
 */
class ItemCarritoSearch extends ItemCarrito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_item_carrito', 'disenio_id', 'carrito_id', 'cantidad'], 'integer'],
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
        $query = ItemCarrito::find();

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
            'id_item_carrito' => $this->id_item_carrito,
            'disenio_id' => $this->disenio_id,
            'carrito_id' => $this->carrito_id,
            'cantidad' => $this->cantidad,
        ]);

        return $dataProvider;
    }
}
