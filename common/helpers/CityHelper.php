<?php


namespace common\helpers;


use backend\models\Recipient;

class CityHelper
{
	public static function getRecipientsByThemeCurrentCity($themeId){

		$allRecipients = '';

		$recipients = Recipient::find()
			->andWhere(['theme_id' => $themeId])
			->andWhere([ 'city_id' => CITY_ID])
			->all();

		foreach ($recipients as $row) {
			$recipientRow = $row -> recipient;
			$recipientRow = trim($recipientRow,',');
			$pos      = strripos($recipientRow, ',');
			if ($pos === false) {
				if (filter_var($recipientRow, FILTER_VALIDATE_EMAIL)) {
					$allRecipients .= $recipientRow.',';
				}
			} else {
				$step2 = explode(',',$recipientRow);
				if(!empty($step2)){
					foreach ($step2 as $item) {

						$email = trim($item);
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

							/**/
							$trim = trim($email);
							$filter_var = filter_var($trim, FILTER_SANITIZE_EMAIL);
							$iconv = iconv('ISO-8859-1','UTF-8//IGNORE', $filter_var);
							/**/
							$allRecipients .= $iconv.',';
						}
					}
				}
			}
		}

		return $allRecipients;
	}

	public static function getRecipientsCenterByThemeCurrentCity($themeId){

		$result = [];

		$recipients = Recipient::find()
			->andWhere(['theme_id' => $themeId])
			->andWhere([ 'city_id' => CITY_ID])
			->with('center')
			->one();

		if(!empty($recipients)){
			if(!empty($recipients->center)){
				$result = $recipients->center;
			}
		}

		return $result;
	}

	public static function filterPhoneGetDigitOnly($phone)
	{
		$result = '';

		if(!empty($phone)){
			$result = preg_replace("/[^,.0-9]/", '', $phone);
		}

		return $result;
	}
}