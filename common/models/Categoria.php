<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property string $nombre
 * @property string $descripción
 * @property int $categoria_padre
 * @property int $orden_categoria
 * @property int $hogar
 * @property int $moda
 * @property int $orden_hogar
 * @property int $orden_moda
 *
 * @property Categoria $categoriaPadre
 * @property Categoria[] $categorias
 * @property Tela[] $telas
 * @property Vidriera[] $vidrieras
 * @property CategoriaTelas[] $categoriaTelas
 */
class Categoria extends \yii\db\ActiveRecord
{
    public $parent_category;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_categoria'], 'required'],
            [['descripción'], 'string'],
            [['categoria_padre', 'orden_categoria','orden_hogar','orden_moda','hogar','moda'], 'integer'],
            [['nombre_categoria','parent_category'], 'string', 'max' => 45],
            [['categoria_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_padre' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => Yii::t('app', 'Id Categoria'),
            'nombre_categoria' => Yii::t('app', 'Nombre'),
            'descripción' => Yii::t('app', 'Descripción'),
            'categoria_padre' => Yii::t('app', 'Categoria Principal'),
            'orden_categoria' => Yii::t('app', 'Orden Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaPadre()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'categoria_padre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['categoria_padre' => 'id_categoria'])->orderBy('orden_categoria');
    }
    public function getCategoriaTelas()
    {
        return $this->hasMany(CategoriaTela::className(), ['categoria_id' => 'id_categoria'])->orderBy('orden');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelas()
    {
        return $this->hasMany(Tela::className(), ['categoria_id' => 'id_categoria'])->orderBy('orden_tela');
    }
    public function getVidrieras()
    {
        return $this->hasMany(Vidriera::className(), ['categoria_id' => 'id_categoria'])->orderBy('orden_vidriera');
    }
    
    function getParentCategory(){
        $parent = $this->hogar?'Hogar':'Moda';
        return $this->nombre_categoria." ($parent)";
    }
    
    function getNroTelas(){
        return count($this->categoriaTelas);
    }
}
