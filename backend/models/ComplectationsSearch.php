<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ComplectationsSearch represents the model behind the search form of `backend\models\Complectations`.
 */
class ComplectationsSearch extends Complectations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'specifications_file', 'weight', 'sort', 'gallery1_id', 'gallery2_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'modelField', 'price', 'title', 'code', 'brief', 'qualities', 'property_weight', 'property_carrying', 'property_engine', 'property_transmission', 'property_drive_wheels', 'text_preview', 'text_col'], 'safe'],
        ];
    }

	public $modelField;


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
        $query = Complectations::find();
	    $query->joinWith(['model']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


	    $dataProvider->sort->attributes['modelField'] = [
		    'asc' => [self::tableName().'.model_id' => SORT_ASC],
		    'desc' => [self::tableName().'.model_id' => SORT_DESC],
	    ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

	    $query->filterWhere([Models::tableName().'.id' => $this->modelField]);

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.model_id' => $this->model_id,
            self::tableName().'.specifications_file' => $this->specifications_file,
            self::tableName().'.weight' => $this->weight,
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.gallery1_id' => $this->gallery1_id,
            self::tableName().'.gallery2_id' => $this->gallery2_id,
            self::tableName().'.active' => $this->active,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike',self::tableName().'.price', $this->price])
            ->andFilterWhere(['ilike',self::tableName().'.title', $this->title])
            ->andFilterWhere(['ilike',self::tableName().'.code', $this->code])
            ->andFilterWhere(['ilike',self::tableName().'.brief', $this->brief])
            ->andFilterWhere(['ilike',self::tableName().'.qualities', $this->qualities])
            ->andFilterWhere(['ilike',self::tableName().'.preview_picture', $this->preview_picture])
            ->andFilterWhere(['ilike',self::tableName().'.detail_picture', $this->detail_picture])
            ->andFilterWhere(['ilike',self::tableName().'.property_weight', $this->property_weight])
            ->andFilterWhere(['ilike',self::tableName().'.property_carrying', $this->property_carrying])
            ->andFilterWhere(['ilike',self::tableName().'.property_engine', $this->property_engine])
            ->andFilterWhere(['ilike',self::tableName().'.property_transmission', $this->property_transmission])
            ->andFilterWhere(['ilike',self::tableName().'.property_drive_wheels', $this->property_drive_wheels])
            ->andFilterWhere(['ilike',self::tableName().'.text_preview', $this->text_preview])
            ->andFilterWhere(['ilike',self::tableName().'.text_col', $this->text_col]);



	    if(empty($params)){
		    $query->orderBy([
			    self::tableName().'.model_id' => SORT_DESC,
			    self::tableName().'.weight' => SORT_ASC,
			    self::tableName().'.sort' => SORT_ASC,
		    ]);
	    }
        return $dataProvider;
    }
}
