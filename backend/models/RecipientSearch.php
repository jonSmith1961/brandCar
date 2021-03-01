<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RecipientSearch represents the model behind the search form of `backend\models\Recipient`.
 */
class RecipientSearch extends Recipient
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'center_id', 'city_id', 'theme_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['recipient', 'centerName', 'cityName', 'themeName'], 'safe'],
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

    public $themeName;
    public $cityName;
    public $centerName;


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Recipient::find();
	    $query->joinWith(['theme']);
	    $query->joinWith(['city']);
	    $query->joinWith(['center']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

	    $dataProvider->sort->attributes['themeName'] = [
		    'asc' => [ThemeMessage::tableName().'.id' => SORT_ASC],
		    'desc' => [ThemeMessage::tableName().'.id' => SORT_DESC],
	    ];

	    $dataProvider->sort->attributes['cityName'] = [
		    'asc' => [City::tableName().'.id' => SORT_ASC],
		    'desc' => [City::tableName().'.id' => SORT_DESC],
	    ];

	    $dataProvider->sort->attributes['centerName'] = [
		    'asc' => [DealerCenter::tableName().'.id' => SORT_ASC],
		    'desc' => [DealerCenter::tableName().'.id' => SORT_DESC],
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
//            'city_id' => $this->city_id,
//            'theme_id' => $this->theme_id,
            self::tableName().'.active' => $this->active,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

	    $query->andFilterWhere([City::tableName().'.id' => $this->cityName]);
	    $query->andFilterWhere([ThemeMessage::tableName().'.id' => $this->themeName]);
	    $query->andFilterWhere([DealerCenter::tableName().'.id' => $this->centerName]);

        $query->andFilterWhere(['ilike', self::tableName().'.recipient', $this->recipient]);

        return $dataProvider;
    }
}
