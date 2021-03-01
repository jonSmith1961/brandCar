<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dealer_center".
 *
 * @property int $id ID
 * @property string $name Название
 * @property int|null $city_id Город
 * @property string $phone Телефон
 * @property string|null $email E-mail
 * @property string $address Адрес
 * @property string|null $post_code Индекс
 * @property string|null $latitude Координаты широта
 * @property string|null $longitude Координаты долгота
 * @property string|null $map_link Ссылка для карты
 * @property int $active Активность
 * @property string $start_time Начало работы будни
 * @property string $end_time Окончание работы будни
 * @property string|null $start_time_saturday Начало работы в субботу
 * @property string|null $end_time_saturday Окончание работы в субботу
 * @property string|null $start_time_sunday Начало работы в восскресенье
 * @property string|null $end_time_sunday Окончание работы в восскресенье
 * @property string|null $start_time_holidays Начало работы в праздники
 * @property string|null $end_time_holidays Окончание работы в праздники
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property City $city
 * @property Departments[] $departments
 */
class DealerCenter  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealer_center';
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

	public $cityName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'name', 'phone', 'address', 'latitude', 'longitude', 'start_time', 'end_time'], 'required'],
            [['city_id', 'active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['city_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone', 'email', 'address', 'post_code', 'map_link', 'start_time', 'end_time', 'start_time_saturday', 'end_time_saturday', 'start_time_sunday', 'end_time_sunday', 'start_time_holidays', 'end_time_holidays'], 'string', 'min' => 2, 'max' => 255],
	        ['phone','match', 'pattern' => '/^[0-9 \t\v\r\n\f \(\)\-\+]{5,20}$/', 'message' => ' Введите корректный номер телефона [0-9 () - + ]'],
	        [['latitude', 'longitude'], 'match', 'pattern' => '/^[0-9\.]{5,20}$/', 'message' => ' Введите корректные координаты [0-9 .]'],
	        [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
	        ['email', 'email'],
	        [['name', 'email', 'address', 'post_code', 'phone', 'latitude', 'longitude', 'map_link'], 'filter', 'filter' => 'trim'],
	        ['post_code','match', 'pattern' => '/^[0-9 \t\v\r\n\f ]{5,20}$/', 'message' => ' Введите корректный индекс'],
	        [['start_time', 'end_time'], 'validateDate'],
	        [['start_time_saturday', 'end_time_saturday'], 'validateSaturdayDate'],
	        [['start_time_sunday', 'end_time_sunday'], 'validateSundayDate'],
	        [['start_time_holidays', 'end_time_holidays'], 'validateHolidaysDate'],
        ];
    }

	public function validateDate(){
    	$customName = '';
    	$errorText = 'в будни';
		$this->validateWorkTime($customName, $errorText);
	}

	public function validateSaturdayDate(){
    	$customName = '_saturday';
    	$errorText = 'в субботу';
		$this->validateWorkTime($customName, $errorText);
	}

	public function validateSundayDate(){
    	$customName = '_sunday';
    	$errorText = 'в восскресенье';
		$this->validateWorkTime($customName, $errorText);
	}

	public function validateHolidaysDate(){
    	$customName = '_holidays';
    	$errorText = 'в праздники';
		$this->validateWorkTime($customName, $errorText);
	}

	public function validateWorkTime($customName, $errorText){
		$startTime = 'start_time'.$customName;
		$endTime = 'end_time'.$customName;
		if (!empty($this->$startTime) || !empty($this->$endTime)){
			if (!empty($this->$startTime) && !empty($this->$endTime)){
				if ($this->$startTime > $this->$endTime) {
					$this->addError($startTime, '"Проверьте время окончания '.$errorText.'"');
					$this->addError($endTime, '"Время окончания", не может быть раньше "времени начала '.$errorText.'"');
				}
				if ($this->$startTime == $this->$endTime) {
					$this->addError($startTime, '"Проверьте время окончания '.$errorText.'"');
					$this->addError($endTime, '"Время окончания", не может быть равно "времени начала '.$errorText.'"');
				}
			} else {
				if (empty($this->$startTime)) {
					$this->addError($startTime, '"Значение не может быть пустым"');
				}
				if (empty($this->$endTime)) {
					$this->addError($endTime, '"Значение не может быть пустым"');
				}
			}
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
            'city_id' => 'Город',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'address' => 'Адрес',
            'post_code' => 'Индекс',
            'latitude' => 'Координаты "широта"',
            'longitude' => 'Координаты "долгота"',
            'map_link' => 'Ссылка для карты',
            'active' => 'Активность',
            'start_time' => 'Начало работы в будни',
            'end_time' => 'Окончание работы в будни',
            'start_time_saturday' => 'Начало работы в субботу',
            'end_time_saturday' => 'Окончание работы в субботу',
            'start_time_sunday' => 'Начало работы в восскресенье',
            'end_time_sunday' => 'Окончание работы в восскресенье',
            'start_time_holidays' => 'Начало работы в праздники',
            'end_time_holidays' => 'Окончание работы в праздники',
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
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery|DepartmentsQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['center_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DealerCenterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DealerCenterQuery(get_called_class());
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
}
