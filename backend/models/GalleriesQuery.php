<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Galleries]].
 *
 * @see Galleries
 */
class GalleriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Galleries[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Galleries|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	/**
	 * {@inheritdoc}
	 * @return GalleriesQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([Galleries::tableName().'.active' => 1]);
	}


	/**
	 * {@inheritdoc}
	 * @return GalleriesQuery the active query used by this AR class.
	 */
	public function activeAndCurrentCity()
	{
		return $this->joinWith('cities')
			->where([ City::tableName().'.id' => CITY_ID])
			->andWhere([Galleries::tableName().'.active' => 1]);
	}
}
