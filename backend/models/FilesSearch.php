<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FileSearch represents the model behind the search form of `backend\models\File`.
 */
class FilesSearch extends Files
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['original_name', 'type', 'filename', 'width', 'height', 'size'], 'safe'],
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
        $query = Files::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', self::tableName().'.original_name', $this->original_name])
            ->andFilterWhere(['ilike', self::tableName().'.type', $this->type])
            ->andFilterWhere(['ilike', self::tableName().'.filename', $this->filename])
            ->andFilterWhere(['ilike', self::tableName().'.width', $this->width])
            ->andFilterWhere(['ilike', self::tableName().'.height', $this->height])
            ->andFilterWhere(['ilike', self::tableName().'.size', $this->size]);

	    if(empty($params)){
		    $query->orderBy([
			    self::tableName().'.id' => SORT_DESC,
		    ]);
	    }
        return $dataProvider;
    }
}
