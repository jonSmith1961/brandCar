<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Complectations]].
 *
 * @see Complectations
 */
class ComplectationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Complectations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Complectations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


	/**
	 * {@inheritdoc}
	 * @return ComplectationsQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([Complectations::tableName().'.active' => 1]);
	}
}
