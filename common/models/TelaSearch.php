<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tela;

/**
 * TelaSearch represents the model behind the search form of `common\models\Tela`.
 */
class TelaSearch extends Tela
{
    public $categoria_padre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tela', 'orden_tela', 'categoria_id', 'largo', 'ancho'], 'integer'],
            [['descripcion_larga_tela','descripcion_tela','codigo_tela', 'path_foto_tela','nombre_tela','categoria_padre'], 'safe'],
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
        $query = Tela::find();
        $query->joinWith('categoria');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['orden_tela'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_tela' => $this->id_tela,
            'orden_tela' => $this->orden_tela,
            'categoria_id' => $this->categoria_id,
            'categoria_padre' => $this->categoria_padre,
            'largo' => $this->largo,
            'ancho' => $this->ancho,
        ]);

        $query
                ->andFilterWhere(['like', 'codigo_tela', $this->codigo_tela])
                ->andFilterWhere(['like', 'nombre_tela', $this->nombre_tela])
                ->andFilterWhere(['like', 'descripcion_tela', $this->descripcion_tela])
                ->andFilterWhere(['like', 'descripcion_larga_tela', $this->descripcion_larga_tela])
            ->andFilterWhere(['like', 'path_foto_tela', $this->path_foto_tela]);

        return $dataProvider;
    }
}
