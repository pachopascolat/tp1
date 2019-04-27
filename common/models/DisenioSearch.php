<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Disenio;

/**
 * DisenioSearch represents the model behind the search form of `common\models\Disenio`.
 */
class DisenioSearch extends Disenio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_disenio', 'tela_id', 'stock'], 'integer'],
            [['nombre_disenio', 'descripcion_disenio', 'orden_disenio', 'path_foto_disenio'], 'safe'],
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
        $query = Disenio::find();

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
            'id_disenio' => $this->id_disenio,
            'tela_id' => $this->tela_id,
            'stock' => $this->stock,
        ]);

        $query->andFilterWhere(['like', 'nombre_disenio', $this->nombre_disenio])
            ->andFilterWhere(['like', 'descripcion_disenio', $this->descripcion_disenio])
            ->andFilterWhere(['like', 'orden_disenio', $this->orden_disenio])
            ->andFilterWhere(['like', 'path_foto_disenio', $this->path_foto_disenio]);

        return $dataProvider;
    }
}
