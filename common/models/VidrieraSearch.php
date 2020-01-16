<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vidriera;

/**
 * common\models\VidrieraSearch represents the model behind the search form about `common\models\Vidriera`.
 */
class VidrieraSearch extends Vidriera {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_vidriera', 'categoria_id', 'orden_vidriera', 'categoria_padre'], 'integer'],
            [['nombre', 'estado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Vidriera::find()->joinWith('categoria');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => [
//                'categoria_id' => SORT_ASC,
                'orden_vidriera' => SORT_ASC,
                ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_vidriera' => $this->id_vidriera,
            'categoria_id' => $this->categoria_id,
//            'categoria_padre' => $this->categoria_padre,
            'orden_vidriera' => $this->orden_vidriera,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
                ->andFilterWhere(['like', 'estado', $this->estado]);

        $query->orFilterWhere([
//                        'categoria_id' => $this->categoria_id,
            'categoria_padre' => $this->categoria_id
        ]);


        return $dataProvider;
    }

}
