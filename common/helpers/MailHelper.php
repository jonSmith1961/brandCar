<?php


namespace common\helpers;


class MailHelper
{

	public static function createMailBody (array $data)
	{
		$mailBody = '';
		foreach ($data as $name => $value) {
			$mailBody .= '<b>' . $name . ':</b> ' . $value . '<br>';
		}
		return $mailBody;
	}

}