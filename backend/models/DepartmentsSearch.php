<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * DepartmentsSearch represents the model behind the search form of `backend\models\Departments`.
 */
class DepartmentsSearch extends Departments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'center_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone', 'centerName', 'email', 'start_time', 'end_time', 'start_time_saturday', 'end_time_saturday', 'start_time_sunday', 'end_time_sunday', 'start_time_holidays', 'end_time_holidays'], 'safe'],
        ];
    }

    public $centerName;

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
        $query = Departments::find();
	    $query->joinWith(['center']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


	    $dataProvider->sort->attributes['centerName'] = [
		    'asc' => [self::tableName().'.center_id' => SORT_ASC],
		    'desc' => [self::tableName().'.center_id' => SORT_DESC],
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
            self::tableName().'.center_id' => $this->center_id,
            self::tableName().'.active' => $this->active,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

	    $query->andFilterWhere([self::tableName().'.center_id' => $this->centerName]);

	    $query->andFilterWhere(['ilike',  self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike',  self::tableName().'.phone', $this->phone])
            ->andFilterWhere(['ilike',  self::tableName().'.email', $this->email])
            ->andFilterWhere(['ilike',  self::tableName().'.start_time', $this->start_time])
            ->andFilterWhere(['ilike',  self::tableName().'.end_time', $this->end_time])
            ->andFilterWhere(['ilike',  self::tableName().'.start_time_saturday', $this->start_time_saturday])
            ->andFilterWhere(['ilike',  self::tableName().'.end_time_saturday', $this->end_time_saturday])
            ->andFilterWhere(['ilike',  self::tableName().'.start_time_sunday', $this->start_time_sunday])
            ->andFilterWhere(['ilike',  self::tableName().'.end_time_sunday', $this->end_time_sunday])
            ->andFilterWhere(['ilike',  self::tableName().'.start_time_holidays', $this->start_time_holidays])
            ->andFilterWhere(['ilike',  self::tableName().'.end_time_holidays', $this->end_time_holidays]);

        return $dataProvider;
    }
}
