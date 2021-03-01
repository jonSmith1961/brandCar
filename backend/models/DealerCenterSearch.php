<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DealerCenterSearch represents the model behind the search form of `backend\models\DealerCenter`.
 */
class DealerCenterSearch extends DealerCenter
{
	public $cityName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [
            	[
            		'name',
		            'phone',
		            'email',
		            'address',
		            'post_code',
		            'latitude',
		            'longitude',
		            'map_link',
		            'start_time',
		            'end_time',
		            'start_time_saturday',
		            'end_time_saturday',
		            'start_time_sunday',
		            'end_time_sunday',
		            'start_time_holidays',
		            'cityName',
		            'end_time_holidays'
	            ],
	            'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DealerCenter::find();
	    $query->joinWith(['city']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


	    $dataProvider->sort->attributes['cityName'] = [
		    'asc' => [City::tableName().'.id' => SORT_ASC],
		    'desc' => [City::tableName().'.id' => SORT_DESC],
	    ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
	        self::tableName().'.id' => $this->id,
	        self::tableName().'.active' => $this->active,
        ]);

	    $query->andFilterWhere([City::tableName().'.id' => $this->cityName]);

	    $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike', self::tableName().'.phone', $this->phone])
            ->andFilterWhere(['ilike', self::tableName().'.email', $this->email])
            ->andFilterWhere(['ilike', self::tableName().'.address', $this->address])
            ->andFilterWhere(['ilike', self::tableName().'.post_code', $this->post_code])
            ->andFilterWhere(['ilike', self::tableName().'.map_link', $this->map_link])
            ->andFilterWhere(['ilike', self::tableName().'.start_time', $this->start_time])
            ->andFilterWhere(['ilike', self::tableName().'.end_time', $this->end_time])
            ->andFilterWhere(['ilike', self::tableName().'.start_time_saturday', $this->start_time_saturday])
            ->andFilterWhere(['ilike', self::tableName().'.end_time_saturday', $this->end_time_saturday])
            ->andFilterWhere(['ilike', self::tableName().'.start_time_sunday', $this->start_time_sunday])
            ->andFilterWhere(['ilike', self::tableName().'.end_time_sunday', $this->end_time_sunday])
            ->andFilterWhere(['ilike', self::tableName().'.start_time_holidays', $this->start_time_holidays])
            ->andFilterWhere(['ilike', self::tableName().'.end_time_holidays', $this->end_time_holidays])
	    ;

        return $dataProvider;
    }
}
