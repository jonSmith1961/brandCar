<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Specials]].
 *
 * @see Specials
 */
class SpecialsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Specials[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Specials|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


	/**
	 * {@inheritdoc}
	 * @return SpecialsQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([Specials::tableName().'.active' => 1]);
	}

	/**
	 * {@inheritdoc}
	 * @return SpecialsQuery the active query used by this AR class.
	 */
	public function currentCity()
	{
		return $this->joinWith('cities')->andwhere([ City::tableName().'id' => CITY_ID]);
	}

	/**
	 * {@inheritdoc}
	 * @return SpecialsQuery the active query used by this AR class.
	 */
	public function activeAndCurrentCity()
	{
		return $this->joinWith('cities')
			->where([ City::tableName().'.id' => CITY_ID])
			->andWhere([Specials::tableName().'.active' => 1]);
	}
}
