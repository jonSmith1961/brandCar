<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SpecialsSearch represents the model behind the search form of `backend\models\Specials`.
 */
class SpecialsSearch extends Specials
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'sort', 'citiesField', 'created_at', 'updated_at'], 'integer'],
            [['alias', 'title', 'brief', 'text', 'sub_title', 'url'], 'safe'],
        ];
    }

	public $citiesField;


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
        $query = Specials::find();
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
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.preview_picture' => $this->preview_picture,
            self::tableName().'.detail_picture' => $this->detail_picture,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere([City::tableName().'.id' => $this->citiesField]);

        $query->andFilterWhere(['ilike', self::tableName().'.alias', $this->alias])
            ->andFilterWhere(['ilike', self::tableName().'.title', $this->title])
            ->andFilterWhere(['ilike', self::tableName().'.brief', $this->brief])
            ->andFilterWhere(['ilike', self::tableName().'.text', $this->text])
            ->andFilterWhere(['ilike', self::tableName().'.sub_title', $this->sub_title])
            ->andFilterWhere(['ilike', self::tableName().'.url', $this->url]);

	    if(empty($params)){
		    $query->orderBy([
			    self::tableName().'.sort' => SORT_ASC,
			    self::tableName().'.id' => SORT_DESC,
		    ]);
	    }

        return $dataProvider;
    }
}
