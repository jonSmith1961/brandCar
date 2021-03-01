<?php

namespace common\helpers;


use backend\models\Files;
use yii\web\UploadedFile;
use Yii;

class ModelsHelper
{

	public static function holdOldValuesInArray($model)
	{
		$nameFieldsFile = $model::$fieldsNamesInputFile;

		foreach ($nameFieldsFile as $fieldName) {
			if(!empty($model->$fieldName)){
				$fieldNameOldKey = 'old_'. $fieldName;
				$model->$fieldNameOldKey = $model->$fieldName;

				$fieldRealNameProperty =  $fieldName. '_real_file_name';
				$model->$fieldRealNameProperty = File::getRealName($model->$fieldName);
			}
		}

		return $model;
	}

	public static function saveFilesFromPost($model, $imageLoad = false)
	{
		$nameFieldsFile = $model::$fieldsNamesInputFile;

		foreach ($nameFieldsFile as $fieldName) {

			$fieldNameOldKey = 'old_'. $fieldName;
			$delKey = 'del_'.$fieldName;
			$oldValue = '';

			if(!empty($model->$fieldNameOldKey)){
				$oldValue = $model->$fieldNameOldKey;
			}

			if (isset(Yii::$app->request->post()[$delKey]) && Yii::$app->request->post()[$delKey]) {
				$model->$fieldName = null;
			} else {
				$previewFile = UploadedFile::getInstance($model, $fieldName);

				if($imageLoad){
					if(File::isImageFile($previewFile)) {
						$file = new Files();
						$model->$fieldName = ($previewFile ? $file->loadFile($previewFile) : $oldValue);
					}
				} else {
					$file = new Files();
					$model->$fieldName = ($previewFile ? $file->loadFile($previewFile) : $oldValue);
				}
			}
		}

		return $model;
	}

	public static function loadAndSaveFilesFromPost($model, $imageLoad = false)
	{

		$nameFieldsFile = $model::$fieldsNamesInputFile;

		foreach ($nameFieldsFile as $fieldName) {

			$fieldNameOldKey = 'old_'. $fieldName;
			$delKey = 'del_'.$fieldName;
			$oldValue = '';

			if(!empty($model->$fieldNameOldKey)){
				$oldValue = $model->$fieldNameOldKey;
			}

			if (isset(Yii::$app->request->post()[$delKey]) && Yii::$app->request->post()[$delKey]) {
				$model->$fieldName = null;
			} else {
				$previewFile = UploadedFile::getInstance($model, $fieldName);
				if (!empty($previewFile)) {
					if($imageLoad){
						if(File::isImageFile($previewFile)) {
							$file = new Files();
							$model->$fieldName = ($previewFile ? $file->loadFile($previewFile) : $oldValue);
						}
					} else {
						$file = new Files();
						$model->$fieldName = ($previewFile ? $file->loadFile($previewFile) : $oldValue);
					}
				}
			}
		}

		return $model;
	}

	public static function loadAndSaveFilesImageAndDocFromPost($model)
	{

		$nameFieldsFile = $model::$fieldsNamesInputFile;

		foreach ($nameFieldsFile as $fieldName) {
			$delKey = 'del_'.$fieldName;

			if (isset(Yii::$app->request->post()[$delKey]) && Yii::$app->request->post()[$delKey]) {


				$model->$fieldName = null;
			} else {
				$previewFile = UploadedFile::getInstance($model, $fieldName);
				if (!empty($previewFile)) {
					$file = new Files();
					$model->$fieldName = ($previewFile ? $file->loadFile($previewFile) : '');
				}
			}
		}

		return $model;
	}

}