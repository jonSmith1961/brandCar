<?php

namespace backend\models;

use common\helpers\File;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news".
 *
 * @property int $id ID
 * @property string $alias Символьный код
 * @property string $title Заголовок
 * @property string $brief Анонс
 * @property string|null $text Текст
 * @property string|null $sub_title Подзаголовок
 * @property int $active_from Дата
 * @property int $active Активность
 * @property int|null $sort Сортировка
 * @property string $preview_picture Картинка анонса
 * @property string|null $detail_picture Детальная картинка
 * @property int|null $city_id Город
 * @property int $created_at Дата создания
 * @property-read \yii\db\ActiveQuery $cities
 * @property int $updated_at Дата обновления
 */
class News  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
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
            [['alias', 'title', 'brief', 'active_from', 'citiesField'], 'required'],
            [['brief', 'text', 'sub_title'], 'string'],
	        [['preview_picture', 'detail_picture'],'validateImageFile'],
	        [['preview_picture'], 'required', 'message' => 'Необходимо заполнить «Изображение».'],
            [['active_from'], 'safe'],
            [['active_from', 'active', 'sort', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['gallery1_id', 'active', 'sort', 'created_at', 'updated_at', 'preview_picture', 'detail_picture'], 'integer'],
            [['alias', 'title'], 'string', 'min' => 2, 'max' => 255],
            [['alias'], 'unique'],
	        ['alias', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
        ];
    }


	public function validateImageFile($attribute)
	{
		if(!empty($this->$attribute)){
			if(!File::isImage($this->$attribute)){
				$this->addError($attribute, 'Необходимо заполнить «Изображение».');
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
            'active_from' => 'Дата',
            'active' => 'Активность',
            'sort' => 'Сортировка',
            'preview_picture' => 'Картинка анонса',
            'detail_picture' => 'Детальная картинка',
	        'gallery1_id' => 'Слайдер1',
            'citiesField' => 'Города',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
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
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCities()
	{
		return $this->hasMany(City::className(), ['id' => 'city_id'])->viaTable('news_to_city', ['news_id' => 'id']);
	}


	/**
	 * Gets query for [[Galleries]].
	 *
	 * @return \yii\db\ActiveQuery|GalleriesQuery
	 */
	public function getGallery1()
	{
		return $this->hasOne(Galleries::className(), ['id' => 'gallery1_id']);
	}


	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGallery1Value()
	{
		return $this->hasMany(GalleryValue::className(), ['galleries_id' => 'gallery1_id']);
	}



}
