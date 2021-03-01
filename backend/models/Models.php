<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use common\helpers\File;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "models".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $menu_name Название в меню
 * @property string $title Заголовок
 * @property string $code Символьный код
 * @property string $brief Описание
 * @property string $qualities Особенности
 * @property string $text_preview Описание
 * @property string $text_col Описание
 * @property string $warranty_year Гарантия в годах
 * @property string $warranty_mileage Гарантия в км
 * @property string $preview_picture Картинка анонса
 * @property string|null $detail_picture Детальная картинка
 * @property int|null $specifications_file Файл технические характеристики модельного ряда
 * @property int|null $catalog_file Файл каталога
 * @property int|null $gallery1_id Слайдер1
 * @property int|null $gallery2_id Слайдер2
 * @property int|null $sort Порядок
 * @property int $active Активность
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property Complectations[] $complectations
 */
class Models  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'models';
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
            [['name', 'menu_name', 'title', 'code', 'brief'], 'required'],
	        [['preview_picture', 'detail_picture'], 'required', 'message' => 'Необходимо заполнить «Изображение».'],
            [['brief', 'qualities', 'text_middle', 'text_preview', 'text_col', 'warranty_year', 'warranty_mileage'], 'string'],
            [['specifications_file', 'catalog_file', 'gallery1_id', 'gallery2_id', 'sort', 'active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['gallery1_id', 'gallery2_id', 'sort', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'menu_name', 'title', 'code'], 'string', 'min' => 2, 'max' => 255],
            [['code'], 'unique'],
	        [['catalog_file', 'specifications_file'],'validateNotImageFile'],
	        [['preview_picture', 'detail_picture'],'validateImageFile'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
        ];
    }

	public function validateNotImageFile($attribute)
	{
		if(!empty($this->$attribute)){
			if(File::isImage($this->$attribute)){
				$this->addError($attribute, 'Проверьте тип файла, выберите не изображение.');
			}
		}
	}

	public function validateImageFile($attribute)
	{
		if(!empty($this->$attribute)){
			if(!File::isImage($this->$attribute)){
				$this->addError($attribute, 'Проверьте тип файла, выберите изображение.');
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
            'menu_name' => 'Название в меню',
            'title' => 'Заголовок',
            'code' => 'Символьный код',
            'brief' => 'Описание',
            'qualities' => 'Особенности',
            'text_middle' => 'Описание в середине',
            'text_preview' => 'Описание внизу слева',
            'text_col' => 'Описание внизу справа',
	        'warranty_year' => 'Гарантия в годах',
            'warranty_mileage' => 'Гарантия в км',
            'preview_picture' => 'Картинка анонса',
            'detail_picture' => 'Детальная картинка',
            'specifications_file' => 'Файл технические характеристики модельного ряда',
            'catalog_file' => 'Файл каталога',
            'gallery1_id' => 'Слайдер1',
            'gallery2_id' => 'Слайдер2',
            'sort' => 'Порядок',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }


	public static $fieldsNamesInputFile = [
		'preview_picture',
		'detail_picture',
		'catalog_file',
		'specifications_file',
	];

	public $preview_picture_real_file_name;
	public $detail_picture_real_file_name;
	public $catalog_file_real_file_name;
	public $specifications_file_real_file_name;

	public $old_preview_picture;
	public $old_detail_picture;
	public $old_catalog_file;
	public $old_specifications_file;


	/**
     * Gets query for [[Complectations]].
     *
     * @return \yii\db\ActiveQuery|ComplectationsQuery
     */
    public function getComplectations()
    {
        return $this->hasMany(Complectations::className(), ['model_id' => 'id']);
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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGallery2Value()
	{
		return $this->hasMany(GalleryValue::className(), ['galleries_id' => 'gallery2_id']);
	}
	/**
	 * Gets query for [[Galleries]].
	 *
	 * @return \yii\db\ActiveQuery|GalleriesQuery
	 */
	public function getGallery2()
	{
		return $this->hasOne(Galleries::className(), ['id' => 'gallery2_id']);
	}

    /**
     * {@inheritdoc}
     * @return ModelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModelsQuery(get_called_class());
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
