<?php

namespace backend\models;

use skobka\jsonField\behaviors\JsonFieldBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $code Символьный код
 * @property string|null $social Соцсети
 * @property string $phone Телефон
 * @property string|null $email E-mail
 * @property string|null $phone_support Телефон поддержки
 * @property int $active Активность
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 */
class City  extends AppModel
{
//	use JsonFieldTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
			'social_json_field' => [
				'class' => JsonFieldBehavior::class,
				'dataField' => 'social', // this is the name of field in db table
			],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'phone'], 'required'],
            [['social'], 'safe'],
            [['active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'code', 'phone', 'email'], 'string', 'min' => 2, 'max' => 255],
            [['phone_support'], 'string', 'min' => 2, 'max' => 20],
	        ['email', 'email'],
	        [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{1}\-[0-9]{3}\-[0-9]{3}$/', 'message' => ' Введите корректный номер телефона' ],
	        [['name', 'code', 'email', 'phone', 'phone_support'], 'filter', 'filter' => 'trim'],
	        [['code'], 'unique'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
	        [['name'], 'unique', 'targetAttribute' => ['name'],
		        'message' => '{attribute} "{value}" уже занят.'
			        . ' Задайте уникальный {attribute}'],
	        ['phone_support','match', 'pattern' => '/^[0-9 \t\v\r\n\f \(\)\-\+]{5,20}$/', 'message' => ' Введите корректный номер телефона [0-9 () - + ]'],
	        ['code','match', 'pattern' => '/^[a-z]{1,}$/', 'message' => ' Введите корректный код используйте строчные латинские буквы'],
	        [['name'], 'validateName'],
        ];
    }


	public function validateName($attribute, $params)
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
            'social' => 'Соцсети',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'phone_support' => 'Телефон поддержки',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }


	public static function getAllActiveIdName()
	{
		$result = [];

		$values = self::find()
			->where([self::tableName().'.active' => 1])
			->orderBy([self::tableName().'.name' => SORT_ASC])
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

	public static function getCurrentCity()
	{
		return self::find()
			->where([ self::tableName().'.active' => 1])
			->where([ self::tableName().'.id' => CITY_ID])
			->one();
	}

	public static function getCurrentCityAsArray()
	{
		$result = [];

		$values = self::find()
			->where([ self::tableName().'.active' => 1])
			->where([ self::tableName().'.id' => CITY_ID])
			->all();


		if(!empty($values)){
			$result = ArrayHelper::map($values, 'id', 'name');
		}


		return $result;
	}


}
