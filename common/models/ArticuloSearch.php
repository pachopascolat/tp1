<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Articulo;

/**
 * ArticuloSearch represents the model behind the search form of `common\models\Articulo`.
 */
class ArticuloSearch extends Articulo {

    public $nombre_tela;
    public $codigo_tela;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_articulo', 'tela_id', 'codigo_color', 'imagen_id', 'existencia', 'estado'], 'integer'],
            [['nombre_color', 'nombre_articulo', 'imageFile', 'nombre_tela', 'codigo_tela'], 'safe'],
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
        $query = Articulo::find()->joinWith('tela');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['codigo_tela'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tela.codigo_tela' => SORT_ASC],
            'desc' => ['tela.codigo_tela' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_tela'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tela.nombre_tela' => SORT_ASC],
            'desc' => ['tela.nombre_tela' => SORT_DESC],
        ];
        // Lets do the same with country now
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_articulo' => $this->id_articulo,
            'tela_id' => $this->tela_id,
            
            'imagen_id' => $this->imagen_id,
            'existencia' => $this->existencia,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre_color', $this->nombre_color])
                ->andFilterWhere(['like', 'nombre_articulo', $this->nombre_articulo])
                ->andFilterWhere(['like', 'codigo_tela', $this->codigo_tela])
                ->andFilterWhere(['like', 'nombre_tela', $this->nombre_tela]);

        return $dataProvider;
    }

}
