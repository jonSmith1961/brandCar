<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ThemeMessage]].
 *
 * @see ThemeMessage
 */
class ThemeMessageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ThemeMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ThemeMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
