<?php

namespace backend\models;

use common\helpers\ValidateHelper;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "gallery_value".
 *
 * @property int $id ID
 * @property int|null $galleries_id id галлереи
 * @property string $name Название
 * @property string|null $url url
 * @property string|null $text Описание
 * @property string|null $property Свойства
 * @property int|null $sort_order Порядок
 * @property int|null $file_id id файла
 *
 * @property Galleries $galleries
 */
class GalleryValue  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_value';
    }

    public $img;
    public $deleteImg;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['galleries_id', 'sort_order', 'file_id'], 'default', 'value' => null],
            [['galleries_id', 'sort_order', 'file_id'], 'integer'],
            [['file_id'], 'required', 'message' => 'Необходимо заполнить «Изображение».'],
            [['name'], 'required'],
            [['text', 'property'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['url'], 'string', 'min' => 2, 'max' => 255],
	        [['url'],'validateUrl'],
            [['galleries_id'], 'exist', 'skipOnError' => true, 'targetClass' => Galleries::className(), 'targetAttribute' => ['galleries_id' => 'id']],
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
            'galleries_id' => 'id галлереи',
            'name' => 'Название',
            'url' => 'url',
            'text' => 'Описание',
            'property' => 'Свойства',
            'sort_order' => 'Порядок',
            'file_id' => 'id файла',
        ];
    }

    /**
     * Gets query for [[Galleries]].
     *
     * @return \yii\db\ActiveQuery|GalleriesQuery
     */
    public function getGalleries()
    {
        return $this->hasOne(Galleries::className(), ['id' => 'galleries_id']);
    }

    /**
     * {@inheritdoc}
     * @return GalleryValueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GalleryValueQuery(get_called_class());
    }

    public static function deleteByIDs($deletedIDs){
	    $result = null;
	    if (! empty($deletedIDs)) {
		    $result = self::deleteAll(['id' => $deletedIDs]);
	    }

	    return $result;
    }
}
