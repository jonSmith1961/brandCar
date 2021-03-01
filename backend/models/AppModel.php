<?php


namespace backend\models;


use yii\helpers\ArrayHelper;

class AppModel extends \yii\db\ActiveRecord
{

	public $allFieldsGroupByType;
	public $allFieldsForFilter;

	public function getAllFieldsGroupByType(){

		$allFields = $this->rules();
		$result = [];

		$allFieldsForFilter = $this->getAllFieldsGroupForFilter();

		if(empty($allFieldsForFilter)){

			die('stop empty allFieldsForFilter');
		}
		$resultTest = [];
		foreach ($allFields as $keyFields => $fields) {

			$prepared = [];
			$fieldsArrayKeyFirstFieldsPreparedRow = [];

			$arrayKeyFirstFields = array_key_first($fields);

			$arrayKeySecondFields = 0;
			if(is_numeric($arrayKeyFirstFields)){
				$arrayKeySecondFields = $arrayKeyFirstFields + 1;
			}

			$fieldsArrayKeyFirstFields = $fields[$arrayKeyFirstFields];
			$fieldsArrayKeySecondFields = $fields[$arrayKeySecondFields];

			if(is_string($fieldsArrayKeySecondFields)){

				if (is_array($fields[$arrayKeyFirstFields])) {
					foreach ($fieldsArrayKeyFirstFields as $fieldsArrayKeyFirstField) {
						if (array_key_exists($fieldsArrayKeyFirstField, $allFieldsForFilter)) {
							$value = ArrayHelper::getValue($allFieldsForFilter, $fieldsArrayKeyFirstField);
							if ($value === 1) {
								$fieldsArrayKeyFirstFieldsPreparedRow[] = $fieldsArrayKeyFirstField;
							}
						}
					}

					$prepared[$fieldsArrayKeySecondFields] = $fieldsArrayKeyFirstFieldsPreparedRow;
				} else {
					$fieldsArrayKeyFirstField = $fieldsArrayKeyFirstFields;
					if (array_key_exists($fieldsArrayKeyFirstField, $allFieldsForFilter)) {
						$value = ArrayHelper::getValue($allFieldsForFilter, $fieldsArrayKeyFirstField);
						if ($value === 1) {
							$fieldsArrayKeyFirstFieldsPreparedRow[] = $fieldsArrayKeyFirstField;
						}
					}

				}

			}

			$result = array_merge($result, $prepared);
			$resultTest[] = $prepared;

		}

		$preparedResultArray = [];
		foreach ($resultTest as $keyGroup => $group) {
			foreach ($group as $keyItems =>$items) {
				foreach ($items as $keyItem =>$item) {
					if(!empty($item)){
						$preparedResultArray[$keyItems][] = $item;
					}
				}
			}
		}

		if(!empty($preparedResultArray)){
			$result = $preparedResultArray;
		}

		$this->allFieldsGroupByType = $result;
		return $this;

	}
	public function getAllFieldsGroupForFilter(){

		$allFields = $this->rules();
		$allFieldsForFilter = [];

		foreach ($allFields as $keyFields => $fields) {
			$arrayKeyFirstFields = array_key_first($fields);


			$arrayKeySecondFields = 0;
			if(is_numeric($arrayKeyFirstFields)){
				$arrayKeySecondFields = $arrayKeyFirstFields + 1;
			}
			if(is_string($fields[$arrayKeySecondFields])){

				if(!in_array($fields[$arrayKeySecondFields], ['required', 'default', 'filter'])) {
					if (is_array($fields[$arrayKeyFirstFields])){
						foreach ($fields[$arrayKeyFirstFields] as $item) {
							$allFieldsForFilter[] = $item;
						}
					} else {
						$allFieldsForFilter[] = $fields[$arrayKeyFirstFields];
					}
				}
			}
		}


		return array_count_values($allFieldsForFilter);

	}

	public function getFieldsByType( $type)
	{
		$result = [];
		if(array_key_exists($type, $this->allFieldsGroupByType)){
			$fieldsByKey = ArrayHelper::getValue($this->allFieldsGroupByType, $type );
			foreach ($fieldsByKey as $item) {
				$result = array_merge($result,[$item =>[$item]]);
			}
		}
		return $result;

	}
}