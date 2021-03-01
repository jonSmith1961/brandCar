<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GalleriesSearch represents the model behind the search form of `backend\models\Galleries`.
 */
class GalleriesSearch extends Galleries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active' ], 'integer'],
            [['name', 'group', 'title', 'code', 'citiesField'], 'safe'],
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
        $query = Galleries::find();
	    $query->joinWith(['cities']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);



	    $dataProvider->sort->attributes['citiesField'] = [
		    'asc' => [City::tableName().'.id' => SORT_ASC],
		    'desc' => [City::tableName().'.id' => SORT_DESC],
	    ];

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


	    $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name]);

	    $query->andFilterWhere([City::tableName().'.id' => $this->citiesField]);

	    $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
		    ->andFilterWhere(['ilike', self::tableName().'.title', $this->title])
		    ->andFilterWhere(['ilike', self::tableName().'.group', $this->group])
		    ->andFilterWhere(['ilike', self::tableName().'.code', $this->code])
	    ;

	    if(empty($params)){
		    $query->orderBy([
			    self::tableName().'.id' => SORT_DESC,
		    ]);
	    }
        return $dataProvider;
    }
}
