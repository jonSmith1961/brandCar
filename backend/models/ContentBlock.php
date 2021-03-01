<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "content_block".
 *
 * @property int $id ID
 * @property string $name Название
 * @property int $active Активность
 * @property string $code Символьный код
 * @property string $content Текст
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property City[] $cities
 * @property ContentBlockVersions[] $contentBlockVersions
 */
class ContentBlock  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_block';
    }

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	public $citiesField;

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'content', 'citiesField'], 'required'],
            [['active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['name', 'code'], 'string', 'min' => 2, 'max' => 255],
            [['code'], 'unique'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'active' => 'Активность',
            'code' => 'Символьный код',
            'content' => 'Текст',
	        'citiesField' => 'Города',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }


    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['id' => 'city_id'])->viaTable('content_block_to_city', ['content_block_id' => 'id']);
    }

    /**
     * Gets query for [[ContentBlockVersions]].
     *
     * @return \yii\db\ActiveQuery|ContentBlockVersionsQuery
     */
    public function getContentBlockVersions()
    {
        return $this->hasMany(ContentBlockVersions::className(), ['content_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ContentBlockQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentBlockQuery(get_called_class());
    }
}
