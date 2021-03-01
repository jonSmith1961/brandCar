<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContentBlockSearch represents the model behind the search form of `backend\models\ContentBlock`.
 */
class ContentBlockSearch extends ContentBlock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_at', 'citiesField', 'updated_at'], 'integer'],
            [['name', 'code', 'content'], 'safe'],
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
        $query = ContentBlock::find();
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
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

	    $query->andFilterWhere([City::tableName().'.id' => $this->citiesField]);

        $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike', self::tableName().'.code', $this->code])
            ->andFilterWhere(['ilike', self::tableName().'.content', $this->content]);

        return $dataProvider;
    }
}
