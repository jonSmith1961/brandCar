<?php


namespace common\helpers;


class ValidateHelper
{

	public static function chekUrlCode($url){

		$result = [];

		$matches[0] = '';

		(preg_match("~[-a-z0-9@:%_\+.#?&/=]{2,256}~i" , $url, $matches));
		preg_match_all('~[:]~', $url, $matchesTest);

		$matchesTestResult = true;

		if(!empty($matchesTest)){
			if(is_array($matchesTest)){
				if(!empty($matchesTest[0])) {
					$matchesTestResult = false;
					if (count($matchesTest[0]) == 1) {
						$matchesTestResult = true;
					}
				}
			}
		}
		$matchesUrl = false;

		if (!empty($matches)){
			if($matches[0] == $url){
				$matchesUrl = true;
			}
		}

		if(!$matchesUrl || !$matchesTestResult){
			$message = 'Введите правильный адрес';
			if(!$matchesTestResult){
				$message .= ', двоеточие можно только одно';
			}

			$result = [
				'message' => $message,
			];

		}

		return $result;
	}

}