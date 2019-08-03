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
    public $codigo_tela;
    public $nombre_tela;
    public $tela_id;
    public $tipo_galeria;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'rank', 'agotado', 'oferta'], 'integer'],
            [['type', 'ownerId', 'name', 'description', 'nombreTela', 'tela_id', 'codigo_tela', 'nombre_tela','tipo_galeria'], 'safe'],
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
//        $query->select(['name','tela.codigo_tela'])->distinct();
//        $query->select(['tela.codigo_tela','tela.codigo_tela','name','description','agotado']);

        $query->joinWith(['galeria']);
        $query->join('LEFT JOIN', 'tela', 'tela_id = id_tela')
//                ->orderBy('codigo_tela, CAST(name AS unsigned)')
                ;
//        $query->where(['tipo_galeria' =>Galeria::DISENIO,'type'=>'galeria']);
        $query->where(['<>','tipo_galeria', Galeria::LISO]);
        $query->andWhere(['agotado'=>false]);
        $query->orWhere(['estado'=>1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['codigo_tela' => SORT_ASC,'name'=>SORT_ASC]]
        ]);

        $dataProvider->sort->attributes['codigo_tela'] = [
            'asc' => ['tela.codigo_tela' => SORT_ASC,'CAST(name AS unsigned)'=>SORT_ASC],
            'desc' => ['tela.codigo_tela' => SORT_DESC,'CAST(name AS unsigned)'=>SORT_ASC],
        ];
        $dataProvider->sort->attributes['name'] = [
            'asc' => ['name' => SORT_ASC],
            'desc' => ['name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_tela'] = [
            'asc' => ['tela.nombre_tela' => SORT_ASC],
            'desc' => ['tela.nombre_tela' => SORT_DESC],
        ];


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
//            'tela_id' => $this->tela_id,
            'type' => $this->type,
            'galeria.tipo_galeria' => $this->tipo_galeria,
            'tela.id_tela'=>$this->tela_id,
        ]);

        $query->andFilterWhere(['like', 'gallery_image.type', $this->type])
                ->andFilterWhere(['like', 'ownerId', $this->ownerId])
//                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'tela.nombre_tela', $this->nombre_tela])
                ->andFilterWhere(['like', 'tela.codigo_tela', $this->codigo_tela])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public function searchOld($params) {
        $query = GalleryImage::find();

        $query->joinWith(['modelo', 'liso', 'discontinuo', 'estampados']);
        $query->join('LEFT JOIN', ['gallery_image as g'], 'disenio_id=g.id');
        $query->join('LEFT JOIN', ['estampado as e'], 'e.id_estampado=g.ownerId');

//        $query->where([
//            'type' => ['estampado', 'modelo', 'lisos', 'discontinuos'],
//        ]);
        $query->andFilterWhere(['or',
            ['estampado.tela_id' => $this->tela_id, 'gallery_image.type' => 'estampado'],
            [
                'e.tela_id' => $this->tela_id,
                'gallery_image.type' => 'modelo'
            ],
            ['estampado.tela_id' => $this->tela_id, 'g.type' => 'modelo'],
//            ['g.type'=>'estampado','gallery_image.type'=>'modelo'], 
            ['lisos.tela_id' => $this->tela_id, 'gallery_image.type' => 'lisos'],
            ['discontinuos.tela_id' => $this->tela_id, 'gallery_image.type' => 'discontinuos']
        ]);

        $query->orderBy('CAST(gallery_image.name AS unsigned)');
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
//        $dataProvider->sort->attributes['name'] = [
//            // The tables are the ones our relation are configured to
//            // in my case they are prefixed with "tbl_"
//            'asc' => ['name' => SORT_ASC],
//            'desc' => ['name' => SORT_DESC],
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
