<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "recipient".
 *
 * @property int $id ID
 * @property int $city_id Город
 * @property int $center_id Дилерский центр
 * @property int $theme_id Тема
 * @property string|null $recipient Получатели
 * @property int $active Активность
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property City $city
 * @property-read \backend\models\ThemeMessageQuery|\yii\db\ActiveQuery $center
 * @property ThemeMessage $theme
 */
class Recipient  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipient';
    }

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipient', 'city_id', 'theme_id', 'center_id'], 'required'],
            [['city_id', 'theme_id', 'active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['city_id', 'center_id', 'theme_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['recipient'], 'string'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['center_id'], 'exist', 'skipOnError' => true, 'targetClass' => DealerCenter::className(), 'targetAttribute' => ['center_id' => 'id']],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThemeMessage::className(), 'targetAttribute' => ['theme_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'center_id' => 'Дилерский центр',
            'city_id' => 'Город',
            'theme_id' => 'Тема',
            'recipient' => 'Получатели',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Theme]].
     *
     * @return \yii\db\ActiveQuery|ThemeMessageQuery
     */
    public function getTheme()
    {
        return $this->hasOne(ThemeMessage::className(), ['id' => 'theme_id']);
    }

    /**
     * Gets query for [[Theme]].
     *
     * @return \yii\db\ActiveQuery|ThemeMessageQuery
     */
    public function getCenter()
    {
        return $this->hasOne(DealerCenter::className(), ['id' => 'center_id']);
    }

    /**
     * {@inheritdoc}
     * @return RecipientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RecipientQuery(get_called_class());
    }
}
