<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ModelsSearch represents the model behind the search form of `backend\models\Models`.
 */
class ModelsSearch extends Models
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'specifications_file', 'catalog_file', 'gallery1_id', 'gallery2_id', 'sort', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'menu_name', 'title', 'code', 'brief', 'qualities', 'text_preview', 'text_col', 'warranty_year', 'warranty_mileage'], 'safe'],
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
        $query = Models::find();

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
            self::tableName().'.specifications_file' => $this->specifications_file,
            self::tableName().'.catalog_file' => $this->catalog_file,
            self::tableName().'.gallery1_id' => $this->gallery1_id,
            self::tableName().'.gallery2_id' => $this->gallery2_id,
            self::tableName().'.sort' => $this->sort,
            self::tableName().'.active' => $this->active,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike', self::tableName().'.menu_name', $this->menu_name])
            ->andFilterWhere(['ilike', self::tableName().'.title', $this->title])
            ->andFilterWhere(['ilike', self::tableName().'.code', $this->code])
            ->andFilterWhere(['ilike', self::tableName().'.brief', $this->brief])
            ->andFilterWhere(['ilike', self::tableName().'.qualities', $this->qualities])
            ->andFilterWhere(['ilike', self::tableName().'.text_preview', $this->text_preview])
            ->andFilterWhere(['ilike', self::tableName().'.text_col', $this->text_col])
            ->andFilterWhere(['ilike', self::tableName().'.warranty_year', $this->warranty_year])
            ->andFilterWhere(['ilike', self::tableName().'.warranty_mileage', $this->warranty_mileage]);

        if(empty($params)){
	        $query->orderBy([
		        self::tableName().'.id' => SORT_ASC,
	        ]);
        }


        return $dataProvider;
    }
}
