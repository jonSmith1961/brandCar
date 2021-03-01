<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ContentBlockVersions]].
 *
 * @see ContentBlockVersions
 */
class ContentBlockVersionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ContentBlockVersions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ContentBlockVersions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
