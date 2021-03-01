<?php

namespace backend\models;

use common\helpers\ValidateHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "specials".
 *
 * @property int $id ID
 * @property string $alias Символьный код
 * @property string $title Заголовок
 * @property string $brief Анонс
 * @property string|null $text Текст
 * @property string|null $sub_title Подзаголовок
 * @property int $active Активность
 * @property string|null $url url
 * @property int|null $sort Сортировка
 * @property int|null $preview_picture Картинка анонса
 * @property int|null $detail_picture Детальная картинка
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property SpecialsToCity[] $specialsToCities
 * @property City[] $cities
 */
class Specials  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specials';
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

	public static $fieldsNamesInputFile = [
		'preview_picture',
		'detail_picture',
	];

	public $citiesField;

	public $preview_picture_real_file_name;
	public $detail_picture_real_file_name;

	public $old_preview_picture;
	public $old_detail_picture;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'brief', 'citiesField'], 'required'],
            [['brief', 'text', 'sub_title'], 'string'],
            [['active', 'sort', 'preview_picture', 'detail_picture', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['active', 'sort', 'preview_picture', 'detail_picture', 'created_at', 'updated_at'], 'integer'],
	        [['preview_picture'], 'required', 'message' => 'Необходимо заполнить «Изображение».'],
            [['alias', 'title', 'url'], 'string', 'min' => 2, 'max' => 255],
	        [['url'],'validateUrl'],
            [['alias'], 'unique'],
	        ['alias', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
        ];
    }

	public function validateUrl($attribute)
	{
		$result = ValidateHelper::chekUrlCode($this->$attribute);
		if(!empty($result)){
			$resultMessage = ArrayHelper::getValue($result, 'message');
			if(!empty($resultMessage)) {
				$this->addError($attribute, $resultMessage);
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
            'alias' => 'Символьный код',
            'title' => 'Заголовок',
            'brief' => 'Анонс',
            'text' => 'Текст',
            'sub_title' => 'Подзаголовок',
            'active' => 'Активность',
            'url' => 'url',
	        'citiesField' => 'Город',
            'sort' => 'Сортировка',
            'preview_picture' => 'Картинка анонса',
            'detail_picture' => 'Детальная картинка',
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
        return $this->hasMany(City::className(), ['id' => 'city_id'])->viaTable('specials_to_city', ['specials_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SpecialsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecialsQuery(get_called_class());
    }
}
