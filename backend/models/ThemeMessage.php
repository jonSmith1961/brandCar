<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "theme_message".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $code Символьный код
 * @property string|null $theme_crm Причина обращения
 * @property int $active Активность
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property Recipient[] $recipients
 */
class ThemeMessage  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theme_message';
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
            [['name', 'code', 'theme_crm'], 'required'],
            [['active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'code', 'theme_crm'], 'string', 'min' => 2, 'max' => 255],
            [['code'], 'unique'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
        ];
    }

	public function validateName($attribute)
	{
		if (!preg_match('/^[а-яё\s-]+$/iu', $this->$attribute)) {
			$this->addError($attribute, 'Используйте русские буквы.');
		}
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'code' => 'Символьный код',
            'theme_crm' => 'Причина обращения',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * Gets query for [[Recipients]].
     *
     * @return \yii\db\ActiveQuery|RecipientQuery
     */
    public function getRecipients()
    {
        return $this->hasMany(Recipient::className(), ['theme_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ThemeMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ThemeMessageQuery(get_called_class());
    }

	public static function getAllActiveIdName()
	{
		$result = [];

		$values = self::find()
			->where(['active' => 1])
			->orderBy(['name' => SORT_ASC])
			->all();

		if(!empty($values)){
			$result = ArrayHelper::map($values, 'id', 'name');
		}

		return $result;
	}

	public static function getAllActiveIds()
	{
		$result = [];

		$values = self::find()
			->where([self::tableName().'.active' => 1])
			->all();

		if(!empty($values)){
			$result = ArrayHelper::getColumn($values, 'id');
		}

		return $result;
	}
}
