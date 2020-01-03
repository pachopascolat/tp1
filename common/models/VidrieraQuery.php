<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Vidriera]].
 *
 * @see Vidriera
 */
class VidrieraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Vidriera[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Vidriera|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
