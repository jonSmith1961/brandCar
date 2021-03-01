<?php

namespace backend\models;


use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "galleries".
 *
 * @property int $id ID
 * @property string $name Название
 *
 * @property GalleryValue[] $galleryValues
 */
class Galleries  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'galleries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'citiesField'], 'required'],
            [['name', 'group', 'code', 'title'], 'string', 'min' => 2, 'max' => 255],
	        [['name', 'title', 'group'], 'filter', 'filter' => 'trim'],
	        [['active'], 'default', 'value' => null],
            [['code','name'], 'unique'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9._-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры, нижнее подчеркивание и тире'],
        ];
    }

	public $citiesField;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
	        'title' => 'Заголовок',
	        'group' => 'Группа',
			'active' => 'Активность',
			'citiesField' => 'Город',
			'code' => 'Код',
        ];
    }

    /**
     * Gets query for [[GalleryValues]].
     *
     * @return \yii\db\ActiveQuery|GalleryValueQuery
     */
    public function getGalleryValues()
    {
        return $this->hasMany(GalleryValue::className(), ['galleries_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return GalleriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GalleriesQuery(get_called_class());
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCities()
	{
		return $this->hasMany(City::className(), ['id' => 'city_id'])->viaTable('galleries_to_city', ['galleries_id' => 'id']);
	}

	public static function getAllActiveGroupName()
	{
		$result = [];

		$values = self::find()
			->select('group')
			->andWhere(['is not', 'group', new Expression('NULL')])
			->distinct()
			->orderBy(['group' => SORT_ASC])
			->asArray()
			->all();

		if(!empty($values)){
			$result = ArrayHelper::map($values, 'group', 'group');
		}

		return $result;
	}

}
