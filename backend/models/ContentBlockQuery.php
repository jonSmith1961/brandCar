<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ContentBlock]].
 *
 * @see ContentBlock
 */
class ContentBlockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ContentBlock[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ContentBlock|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

	public function actual()
	{
		return $this->andWhere([
			ContentBlock::tableName().'.active' => 1,
		]);
	}

	/**
	 * {@inheritdoc}
	 * @return NewsQuery the active query used by this AR class.
	 */
	public function activeAndCurrentCity()
	{
		return $this->joinWith('cities')
			->andWhere([ City::tableName().'.id' => CITY_ID])
			->andWhere([ContentBlock::tableName().'.active' => 1]);
	}
}
