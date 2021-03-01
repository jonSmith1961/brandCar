<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GalleryValueSearch represents the model behind the search form of `backend\models\GalleryValue`.
 */
class GalleryValueSearch extends GalleryValue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'galleries_id', 'sort_order', 'file_id'], 'integer'],
            [['name', 'text', 'property'], 'safe'],
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
        $query = GalleryValue::find();

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
            self::tableName().'.galleries_id' => $this->galleries_id,
            self::tableName().'.sort_order' => $this->sort_order,
            self::tableName().'.file_id' => $this->file_id,
        ]);

        $query->andFilterWhere(['ilike', self::tableName().'.name', $this->name])
            ->andFilterWhere(['ilike', self::tableName().'.text', $this->text])
            ->andFilterWhere(['ilike', self::tableName().'.property', $this->property]);

        return $dataProvider;
    }
}
