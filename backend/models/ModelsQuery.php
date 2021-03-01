<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Models]].
 *
 * @see ModelsHelper
 */
class ModelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Models[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Models|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

	/**
	 * {@inheritdoc}
	 * @return ModelsQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([Models::tableName().'.active' => 1]);
	}
}
