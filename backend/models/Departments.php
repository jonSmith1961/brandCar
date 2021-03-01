<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "departments".
 *
 * @property int $id ID
 * @property string $name Название
 * @property int|null $center_id Диллерский центр
 * @property string $phone Телефон
 * @property string|null $email E-mail
 * @property int $active Активность
 * @property string|null $start_time Начало работы будни
 * @property string|null $end_time Окончание работы будни
 * @property string|null $start_time_saturday Начало работы в субботу
 * @property string|null $end_time_saturday Окончание работы в субботу
 * @property string|null $start_time_sunday Начало работы в восскресенье
 * @property string|null $end_time_sunday Окончание работы в восскресенье
 * @property string|null $start_time_holidays Начало работы в праздники
 * @property string|null $end_time_holidays Окончание работы в праздники
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property DealerCenter $center
 */
class Departments  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	public $centerName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['center_id', 'name', 'phone'], 'required'],
            [['center_id', 'active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['center_id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone', 'email', 'start_time', 'end_time', 'start_time_saturday', 'end_time_saturday', 'start_time_sunday', 'end_time_sunday', 'start_time_holidays', 'end_time_holidays'], 'string', 'min' => 2, 'max' => 255],
	        [['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{1}\-[0-9]{3}\-[0-9]{3}$/', 'message' => ' Введите корректный номер телефона' ],
	        ['email', 'email'],
            [['center_id'], 'exist', 'skipOnError' => true, 'targetClass' => DealerCenter::className(), 'targetAttribute' => ['center_id' => 'id']],
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
            'center_id' => 'Диллерский центр',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'active' => 'Активность',
            'start_time' => 'Начало работы будни',
            'end_time' => 'Окончание работы будни',
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
     * Gets query for [[Center]].
     *
     * @return \yii\db\ActiveQuery|DealerCenterQuery
     */
    public function getCenter()
    {
        return $this->hasOne(DealerCenter::className(), ['id' => 'center_id']);
    }

    /**
     * {@inheritdoc}
     * @return DepartmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepartmentsQuery(get_called_class());
    }
}
