<?php


namespace common\helpers;


use Yii;

class CommonHelper
{
	public static function nicePrint($value, $die = false)
	{
		if (is_bool($value)) {
			$value = 'bool: ' . ($value ? 'true' : 'false');
		} ?>
		<pre style="background-color: #fff; border: 3px solid red"><?php print_r($value) ?></pre><?php
		if ($die) die();
	}

//	public static function sendToCrm($arData)
//	{
//		if (!empty(Yii::$app->session->get('mc_utm'))) {
//			$mc_utm = Yii::$app->session->get('mc_utm');
//			$arData['utm_source'] = !empty($mc_utm['utm_source']) ? $mc_utm['utm_source'] : '';
//			$arData['utm_medium'] = !empty($mc_utm['utm_medium']) ? $mc_utm['utm_medium'] : '';
//			$arData['utm_campaign'] = !empty($mc_utm['utm_campaign']) ? $mc_utm['utm_campaign'] : '';
//			if (empty($mc_utm['utm_source']) && empty($mc_utm['utm_medium']) && empty($mc_utm['utm_campaign'])) {
//				$arData['referrer'] = $mc_utm['referrer'];
//			}
//		}
//		if (YII_ENV_LOCAL) {
//			file_put_contents(Yii::getAlias('@root/' . date('Y.m.d_H.i.s') . '-crm.php'), '<?php $crmFields = ' . var_export($arData, true) . ';');
//		} else {
//			$ch = curl_init();
//			curl_setopt($ch, CURLOPT_URL, 'http://webapp.domen.com/app/site_order.php');
//			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
//			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//			curl_setopt($ch, CURLOPT_TIMEOUT, 3);
//			curl_setopt($ch, CURLOPT_POST, 1);
//			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arData));
//			curl_exec($ch);
//			curl_close($ch);
//		}
//	}



	public static function sendToCrm(array $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://webapp.domen.com/app/site_order.php');
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		if (YII_ENV_LOCAL) {
			file_put_contents(__DIR__ . '/../../crm-' . date('Y-m-d_H-i-s') . '.php', '<?php $data = ' . var_export($data, true) . ';');
		} elseif (YII_ENV != 'test') {
			curl_exec($ch);
		}
		curl_close($ch);
		$ch = curl_init();
		$domain = YII_ENV_LOCAL ? 'http://global.compony.local' : 'https://global.domen.com';
		curl_setopt($ch, CURLOPT_URL, $domain . '/site-order/create/');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_exec($ch);
		curl_close($ch);
	}

	public static function sendToCrmTest(array $data)
	{
		$test = 54;
		if (YII_ENV_LOCAL) {
			file_put_contents(Yii::getAlias('@root/' . date('Y.m.d_H.i.s') . '-crm.php'), '<?php $crmFields = ' . var_export($data, true) . ';');
		}

		$ch = curl_init();
		$domain = YII_ENV_LOCAL ? 'http://global.compony.local' : 'https://global.domen.com';
		curl_setopt($ch, CURLOPT_URL, $domain . '/site-order/create-test/');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_exec($ch);
		curl_close($ch);
	}

}