<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ItemVidirera;

/**
 * ItemVidrieraSearch represents the model behind the search form of `common\models\ItemVidirera`.
 */
class ItemVidrieraSearch extends ItemVidirera {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_item_vidriera', 'articulo_id', 'imagen_id', 'vidriera_id', 'orden_item_vidriera', 'ranking'], 'integer'],
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
        $query = ItemVidirera::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['orden_item_vidriera' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_item_vidriera' => $this->id_item_vidriera,
            'articulo_id' => $this->articulo_id,
            'imagen_id' => $this->imagen_id,
            'vidriera_id' => $this->vidriera_id,
            'orden_item_vidriera' => $this->orden_item_vidriera,
            'ranking' => $this->ranking,
        ]);

        return $dataProvider;
    }
    public function searchConStock($params) {
        $query = ItemVidirera::find()->joinWith('articulo');
        $query->where(['existencia'=>1]);
        $query->orWhere(['visible'=>true]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['orden_item_vidriera' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_item_vidriera' => $this->id_item_vidriera,
            'articulo_id' => $this->articulo_id,
            'imagen_id' => $this->imagen_id,
            'vidriera_id' => $this->vidriera_id,
            'orden_item_vidriera' => $this->orden_item_vidriera,
            'ranking' => $this->ranking,
        ]);

        return $dataProvider;
    }

}
