<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CategoriaTela;

/**
 * CategoriaTelaSearch represents the model behind the search form of `common\models\CategoriaTela`.
 */
class CategoriaTelaSearch extends CategoriaTela
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria_tela', 'tela_id', 'categoria_id', 'orden'], 'integer'],
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
        $query = CategoriaTela::find()->orderBy('orden');

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
            'id_categoria_tela' => $this->id_categoria_tela,
            'tela_id' => $this->tela_id,
            'categoria_id' => $this->categoria_id,
            'orden' => $this->orden,
        ]);

        return $dataProvider;
    }
}
