<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewsSearch represents the model behind the search form of `backend\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active_from', 'active', 'sort', 'citiesField', 'created_at', 'updated_at'], 'integer'],
            [['alias', 'title', 'brief', 'text', 'sub_title'], 'safe'],
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
        $query = News::find();
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


	    if(!empty($this->active_from)){
		    $this->active_from = \Yii::$app->formatter->asTimestamp($this->active_from);
	    }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.active_from' => $this->active_from,
            self::tableName().'.active' => $this->active,
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

	    $query->andFilterWhere([City::tableName().'.id' => $this->citiesField]);

        $query->andFilterWhere(['ilike', self::tableName().'.alias', $this->alias])
            ->andFilterWhere(['ilike', self::tableName().'.title', $this->title])
            ->andFilterWhere(['ilike', self::tableName().'.brief', $this->brief])
            ->andFilterWhere(['ilike', self::tableName().'.text', $this->text])
            ->andFilterWhere(['ilike', self::tableName().'.sub_title', $this->sub_title])
        ;

	    if(empty($params)){
		    $query->orderBy([
			    self::tableName().'.sort' => SORT_ASC,
			    self::tableName().'.active_from' => SORT_DESC,
		    ]);
	    }

        return $dataProvider;
    }
}
