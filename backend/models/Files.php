<?php

namespace backend\models;

use common\helpers\CF;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "file".
 *
 * @property int $id ID
 * @property string $original_name Оригинальное название
 * @property string|null $type Тип
 * @property string|null $filename Имя файла
 * @property string|null $width Ширина
 * @property string|null $height Высота
 * @property string|null $size Размер
 * @property int $created_at Дата создания
 * @property int $updated_at Дата обновления
 */
class Files  extends AppModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
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
            [['original_name'], 'required'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['width', 'height', 'size', 'created_at', 'updated_at'], 'integer'],
            [['original_name', 'type', 'filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'original_name' => 'Оригинальное название',
            'type' => 'Тип',
            'filename' => 'Имя файла',
            'width' => 'Ширина',
            'height' => 'Высота',
            'size' => 'Размер',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilesQuery(get_called_class());
    }


	/**
	 * @param UploadedFile $file_obj
	 * @return bool|int|null
	 */
	public function loadFile(UploadedFile $file_obj = null)
	{
		if (!$file_obj) {
			return null;
		}
		$ar_size = !empty(getimagesize($file_obj->tempName)) ? getimagesize($file_obj->tempName) : ['', ''];
		$ar_file_name = explode('.', $file_obj->name);
		$ext = '.' . end($ar_file_name);
		$file_name = md5($file_obj->name . rand(100000, 999999)) . $ext;
		$dir_name = substr($file_name, 0, 2);
		if (!is_dir(Yii::getAlias('@frontend') . '/web/upload/')) {
			mkdir(Yii::getAlias('@frontend') . '/web/upload/');
		}
		if (!is_dir(Yii::getAlias('@frontend') . '/web/upload/' . $dir_name)) {
			mkdir(Yii::getAlias('@frontend') . '/web/upload/' . $dir_name);
		}
		if ($file_obj->saveAs(Yii::getAlias('@frontend/web/upload/' . $dir_name . '/' . $file_name))) {
			$this->original_name = $file_obj->baseName;
			$this->filename = $file_name;
			$this->size = $file_obj->size;
			$this->type = $file_obj->type;
			$this->width = $ar_size[0];
			$this->height = $ar_size[1];
			$this->created_at = time();
			$this->updated_at = time();
			$vtest = $this->validate();
			if ($this->save()) {
				if (preg_match('/^\.jpe?g$/i', $ext)) {
					exec('jpegoptim --all-progressive -v --strip-all ' . Yii::getAlias('@frontend/web/upload/' . $dir_name . '/' . $file_name));
				} elseif (preg_match('/^\.png$/i', $ext)) {
					exec('optipng -o7 -strip all ' . Yii::getAlias('@frontend/web/upload/' . $dir_name . '/' . $file_name));
				}
				return $this->id;
			}
		}
		return false;
	}

	public static function getPath($file, $domain = false)
	{
		$model = $file instanceof Files ? $file : (is_array($file) ? $file : Files::findOne($file));
		if ($model) {
			$substr = substr($model['filename'], 0, 2);
			if ($domain) {
				$domain = CF::domain();
				return "{$domain}/upload/{$substr}/{$model['filename']}";
			} else {
				return "/upload/{$substr}/{$model['filename']}";
			}
		}
	}

	public static function getAllTypes()
	{
		$result = [];

		$query = self::find()
			->distinct()
			->where(['>','type',0])
			->orderBy(['type' => SORT_ASC]);

		$values = $query->all();
		if(!empty($values)){
			$result = ArrayHelper::map($values, 'type', 'type');
		}

		return $result;
	}

}
