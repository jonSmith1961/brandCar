<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[City]].
 *
 * @see City
 */
class CityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return City[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return City|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

	/**
	 * {@inheritdoc}
	 * @return CityQuery the active query used by this AR class.
	 */
	public function active()
	{
		return $this->where([City::tableName().'.active' => 1]);
	}

	/**
	 * {@inheritdoc}
	 * @return CityQuery the active query used by this AR class.
	 */
	public function currentCity()
	{
		return $this->where([City::tableName().'.code' => CITY_CODE]);
	}
}
