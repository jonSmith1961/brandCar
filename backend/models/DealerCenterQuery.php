<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[DealerCenter]].
 *
 * @see DealerCenter
 */
class DealerCenterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DealerCenter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DealerCenter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

	/**
	 * {@inheritdoc}
	 * @return DealerCenterQuery the active query used by this AR class.
	 */
	public function currentCity()
	{
		return $this->where([ DealerCenter::tableName().'.city_id' => CITY_ID]);
	}

}
