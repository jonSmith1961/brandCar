<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[GalleryValue]].
 *
 * @see GalleryValue
 */
class GalleryValueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GalleryValue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GalleryValue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
