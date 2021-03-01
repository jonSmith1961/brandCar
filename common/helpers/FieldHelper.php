<?php

namespace common\helpers;


use backend\models\Files;
use frontend\helpers\ImageHelper;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\helpers\FileHelper;
use yii\helpers\Html;

class FieldHelper
{


	public static function isImageField($field)
	{
		$result = false;

		if(!empty($field)) {
			$ar_file_name = explode('_', $field);
			$type = ($ar_file_name[array_key_last($ar_file_name)]);
			if ($type === 'picture') {
				$result = true;
			}
		}

		return $result;

	}

	public static function isRequired($model, $fieldName)
	{
		$result = false;

		if(!empty($fieldName)) {
			$rules = $model->rules();

			foreach ($rules as $ruleRow) {
				if($result == true) break;
				if (!empty($ruleRow)) {
					$fields = $ruleRow[0];
					if (!empty($fields)) {
						$ruleСondition = $ruleRow[1];
						if (is_array($fields)) {
							foreach ($fields as $field) {
								if ($field == $fieldName) {
									if ($ruleСondition == 'required') {
										$result = true;
									}
								}
							}
						} elseif (is_string($fields)){
							$field = $fields;
							if ($field == $fieldName) {
								if ($ruleСondition == 'required') {
									$result = true;
								}
							}
						}
					}
				}
			}
		}

		return $result;
	}

}