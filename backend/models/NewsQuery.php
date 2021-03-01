<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[News]].
 *
 * @see News
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

	/**
	 * {@inheritdoc}
	 * @return NewsQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([News::tableName().'.active' => 1]);
	}

	/**
	 * {@inheritdoc}
	 * @return NewsQuery the active query used by this AR class.
	 */
	public function currentCity()
	{
		return $this->with('cities')->where([ City::tableName().'id' => CITY_ID]);
	}

	/**
	 * {@inheritdoc}
	 * @return NewsQuery the active query used by this AR class.
	 */
	public function activeAndCurrentCity()
	{
		return $this->joinWith('cities')
			->where([ City::tableName().'.id' => CITY_ID])
			->andWhere([News::tableName().'.active' => 1]);
	}
}
