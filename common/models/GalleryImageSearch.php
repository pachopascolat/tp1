<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GalleryImage;

/**
 * GalleryImageSearch represents the model behind the search form of `common\models\GalleryImage`.
 */
class GalleryImageSearch extends GalleryImage {

    public $nombreTela;
    public $tela_id;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'rank', 'agotado', 'oferta'], 'integer'],
            [['type', 'ownerId', 'name', 'description', 'nombreTela', 'tela_id'], 'safe'],
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
        $query = GalleryImage::find();

        $query->joinWith(['modelo', 'liso', 'discontinuo', 'estampados']);
        $query->join('LEFT JOIN', ['gallery_image as g'], 'disenio_id=g.id');
        $query->join('LEFT JOIN', ['estampado as e'], 'e.id_estampado=g.ownerId');

//        $query->where([
//            'type' => ['estampado', 'modelo', 'lisos', 'discontinuos'],
//        ]);
        $query->andWhere(['or', 
            ['estampado.tela_id' => $this->tela_id,'gallery_image.type'=>'estampado'], 
            [
            'e.tela_id' => $this->tela_id,
            'gallery_image.type'=>'modelo'
            ], 
//            ['estampado.tela_id' => $this->tela_id,'g.type'=>'estampado'], 
//            ['g.type'=>'estampado','gallery_image.type'=>'modelo'], 
            ['lisos.tela_id' => $this->tela_id,'gallery_image.type'=>'lisos'],
            ['discontinuos.tela_id' => $this->tela_id,'gallery_image.type'=>'discontinuos']
        ]);
//        $query->orWhere([
//            'lisos.tela_id' => $this->tela_id,
//        ]);
//        $query->orWhere([
//            'discontinuo.tela_id' => $this->tela_id,
//        ]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//
//        $dataProvider->sort->attributes['nombreTela'] = [
//            // The tables are the ones our relation are configured to
//            // in my case they are prefixed with "tbl_"
//            'asc' => ['tela.nombre_tela' => SORT_ASC],
//            'desc' => ['tela.nombre_tela' => SORT_DESC],
//        ];




        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'rank' => $this->rank,
            'agotado' => $this->agotado,
            'oferta' => $this->oferta,
            'name' => $this->name,
        ]);
//        $query->orFilterWhere([
//            'estampado.tela_id' => $this->tela_id,
//            'lisos.tela_id' => $this->tela_id,
//            'discontinuos.tela_id' => $this->tela_id,
//        ]);

        $query->andFilterWhere(['like', 'gallery_image.type', $this->type])
                ->andFilterWhere(['like', 'ownerId', $this->ownerId])
//                ->andFilterWhere(['like', 'name', $this->name])
//                ->andFilterWhere(['like', 'tela.nombre_tela', $this->nombreTela])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
