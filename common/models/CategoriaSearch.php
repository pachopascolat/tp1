<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Categoria;

/**
 * CategoriaSearch represents the model behind the search form of `common\models\Categoria`.
 */
class CategoriaSearch extends Categoria {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_categoria', 'categoria_padre', 'orden_categoria'], 'integer'],
            [['nombre_categoria', 'descripción'], 'safe'],
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
        $query = Categoria::find()
//                ->joinWith('categoriaTelas')
                ->orderBy('moda', 'orden_hogar');

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
            'id_categoria' => $this->id_categoria,
            'categoria_padre' => $this->categoria_padre,
            'orden_categoria' => $this->orden_categoria,
            'hogar' => $this->hogar,
            'moda' => $this->moda,
            'orden_hogar' => $this->orden_hogar,
            'orden_moda' => $this->orden_moda,
        ]);

        $query->andFilterWhere(['like', 'nombre_categoria', $this->nombre_categoria])
                ->andFilterWhere(['like', 'descripción', $this->descripción]);

        return $dataProvider;
    }

}
