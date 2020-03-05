<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form of `common\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cliente', 'cuit', 'nro_cliente', 'agendado'], 'integer'],
            [['nombre_cliente', 'telefono', 'mail_cliente', 'direccion_envio'], 'safe'],
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
        $query = Cliente::find();

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
            'id_cliente' => $this->id_cliente,
            'cuit' => $this->cuit,
            'nro_cliente' => $this->nro_cliente,
            'agendado' => $this->agendado,
        ]);

        $query->andFilterWhere(['like', 'nombre_cliente', $this->nombre_cliente])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'mail_cliente', $this->mail_cliente])
            ->andFilterWhere(['like', 'direccion_envio', $this->direccion_envio]);

        return $dataProvider;
    }
}
