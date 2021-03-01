<?php

namespace backend\models;

use common\helpers\File;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "complectations".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string $price Цена
 * @property int|null $model_id Модель
 * @property string $title Заголовок
 * @property string $code Символьный код
 * @property string $brief Описание
 * @property string $qualities Особенности
 * @property string $preview_picture Картинка анонса
 * @property string|null $detail_picture Детальная картинка
 * @property int|null $specifications_file Файл технические характеристики
 * @property int|null $weight Масса
 * @property int|null $sort Порядок
 * @property string|null $property_weight Полная масса
 * @property string|null $property_carrying Грузоподъемность
 * @property string|null $property_engine Двигатель
 * @property string|null $property_transmission Трансмиссия
 * @property string|null $property_drive_wheels Привод ведущие колеса
 * @property string $text_preview Описание
 * @property string $text_col Описание
 * @property int|null $gallery1_id Слайдер1
 * @property int|null $gallery2_id Слайдер2
 * @property int|null $gallery1 Слайдер1
 * @property int|null $gallery2 Слайдер2
 * @property int $active Активность
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 *
 * @property Models $model
 */
class Complectations extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complectations';
    }

	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	public $modelName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'weight', 'title', 'code', 'series', 'brief', 'model_id'], 'required'],
	        [['name', 'price', 'title'], 'filter', 'filter' => 'trim'],
	        [['preview_picture', 'detail_picture'], 'required', 'message' => 'Необходимо заполнить «Изображение».'],
	        [['model_id', 'specifications_file', 'weight', 'sort', 'gallery1_id', 'gallery2_id', 'active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['model_id', 'specifications_file', 'weight', 'sort', 'gallery1_id', 'gallery2_id', 'active', 'preview_picture', 'detail_picture', 'created_at', 'updated_at'], 'integer'],
            [['brief', 'qualities', 'property_weight', 'property_carrying', 'property_engine', 'property_transmission', 'property_drive_wheels', 'text_preview', 'text_col'], 'string'],
            [['name', 'title', 'code', 'series'], 'string', 'min' => 2, 'max' => 255],
            [['series'], 'unique'],
            [['price'], 'integer', 'min' => 1, 'max' => 1000000000000],
	        [['specifications_file'],'validateNotImageFile'],
	        [['preview_picture', 'detail_picture'],'validateImageFile'],
	        ['code', 'match', 'pattern' => '/^[a-zA-Z0-9.-]*$/', 'message' => 'В символьный код входят латинские буквы, цифры и тире'],
	        [['series'], 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
	        [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Models::className(), 'targetAttribute' => ['model_id' => 'id']],
        ];
    }

//    public function getFieldsByType($type = null){
//
//    	$allFields = $this->rules();
//	    $result = [];
//	    foreach ($allFields as $keyFields => $fields) {
////		    foreach ($fields as $keyField => $field) {
//		        $test = 54;
//			    $prepared = [];
//			    $arrayKeyFirstFields = array_key_first($fields);
//
//			    $arrayKeySecondFields = null;
//			    if(is_numeric($arrayKeyFirstFields)){
//				    $arrayKeySecondFields = $arrayKeyFirstFields + 1;
//			    }
//			    if(is_string($fields[$arrayKeySecondFields])){
//				    $prepared[$fields[$arrayKeySecondFields]] = $fields[$arrayKeyFirstFields];
//			    }
//
//			    $result = array_merge($result, $prepared);
//
////		    }
//
//    	}
//	    return $result;
//
//    }


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
				$this->addError($attribute, 'Проверьте тип файла.');
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
            'price' => 'Цена',
            'model_id' => 'Модель',
            'title' => 'Заголовок',
            'code' => 'Символьный код',
            'series' => 'Серия',
            'brief' => 'Описание',
            'qualities' => 'Особенности',
            'preview_picture' => 'Картинка анонса',
            'detail_picture' => 'Детальная картинка',
            'specifications_file' => 'Файл технические характеристики',
            'weight' => 'Масса',
            'sort' => 'Порядок',
            'property_weight' => 'Полная масса',
            'property_carrying' => 'Грузоподъемность',
            'property_engine' => 'Двигатель',
            'property_transmission' => 'Трансмиссия',
            'property_drive_wheels' => 'Привод ведущие колеса',
            'text_preview' => 'Описание',
            'text_col' => 'Описание',
            'gallery1_id' => 'Слайдер1',
            'gallery2_id' => 'Слайдер2',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
	public static $fieldsNamesInputFile = [
		'preview_picture',
		'detail_picture',
		'specifications_file',
	];

	public $preview_picture_real_file_name;
	public $detail_picture_real_file_name;
	public $specifications_file_real_file_name;

	public $old_preview_picture;
	public $old_detail_picture;
	public $old_specifications_file;
    /**
     * Gets query for [[Model]].
     *
     * @return \yii\db\ActiveQuery|ModelsQuery
     */
    public function getModel()
    {
        return $this->hasOne(Models::className(), ['id' => 'model_id']);
    }

    /**
     * {@inheritdoc}
     * @return ComplectationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComplectationsQuery(get_called_class());
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
	 * Gets query for [[Galleries]].
	 *
	 * @return \yii\db\ActiveQuery|GalleriesQuery
	 */
	public function getGallery2()
	{
		return $this->hasOne(Galleries::className(), ['id' => 'gallery2_id']);
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

	public static function getAllWeight($active = false)
	{
		$result = [];

		$query = self::find()
			->distinct()
			->where(['>','weight',0])
			->orderBy(['weight' => SORT_ASC]);

		if($active == true){
			$query->where(['active' => 1]);
		}

		$values = $query->all();
		if(!empty($values)){
			$result = ArrayHelper::map($values, 'weight', 'weight');
		}

		return $result;
	}

}
