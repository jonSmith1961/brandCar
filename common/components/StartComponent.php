<?php

namespace common\components;

use backend\models\City;
use common\helpers\CF;
use Yii;
use yii\base\Component;
use yii\web\NotFoundHttpException;

class StartComponent extends Component
{
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$cacheDuration = 1800;

		$testAppArrayIds = [
			'app-backend-tests' => '',
			'app-frontend-tests' => '',
			'app-common-tests' => '',
			'app-console' => '',
		];

		$yiiAppId =Yii::$app->id;

		$isTestApp = false;
		if(array_key_exists(Yii::$app->id,$testAppArrayIds)){
			$isTestApp = true;
		}

		$accessIsAllowed = false;
		if(Yii::$app->id !== 'app-console' && !$isTestApp){
			$accessIsAllowed = true;
		}

		if ($accessIsAllowed) {
			$get = Yii::$app->request->get();
			$post = Yii::$app->request->post();
		}

		$cache = Yii::$app->cache;

		if($isTestApp) {
			Yii::$app->params['cities'] = [
				'nn' => [
					'id' => 1,
					'name' => 'Нижний Новгород',
					'code' => 'nn',
				]
			];
		} else {
			Yii::$app->params['cities'] = $cache->getOrSet(['cities'], function () {
				return City::find()
					->active()
					->orderBy('name')
					->indexBy('code')
					->asArray()
					->all();
			}, $cacheDuration);
		}

		if ($accessIsAllowed) {
			if (!empty($get)) {
				$strGet = http_build_query($get);
				if (preg_match('/(CHAR\(\d+\)|select|union|concat)/i', $strGet)) {
					throw new NotFoundHttpException('xss');
				}
			}
			if (!empty($post)) {
				$strPost = http_build_query($post);
				if (preg_match('/(CHAR\(\d+\)|union|concat)/i', $strPost)) {
					throw new NotFoundHttpException('xss');
				}
			}
		}
		defined('PROD') or define('PROD', Yii::$app->params['server_name'] == 'isuzu.domen.com');
		if ($accessIsAllowed) {
			defined('IS_BACKEND') or define('IS_BACKEND', substr(parse_url(Yii::$app->request->hostInfo . $_SERVER['REQUEST_URI'], PHP_URL_PATH), 0, 7) == '/admin/');
		}

		if (
			Yii::$app->id === 'app-frontend'
			&& !Yii::$app->request->isAjax
			&& !empty($get)
			&& in_array('', array_values($get))
		) {
			foreach ($get as $k => $v) {
				if (empty($v)) {
					unset($get[$k]);
				}
			}
			$pathInfo = Yii::$app->request->pathInfo;
			$path = (!empty($pathInfo) ? trim($pathInfo, '/') : '');
			if (!empty($path)) {
				$url = "/{$path}/?" . http_build_query($get);
				Yii::$app->response->redirect($url, 301)->send();
			}
			exit(1);
		}

		if ($accessIsAllowed) {
			if (!empty($get)) {
				$new_get = array_filter($get, function ($value) {
					return ($value !== null && $value !== false && $value !== '');
				});
				if (count($new_get) < count($get)) {
					$request_uri = parse_url(Yii::$app->request->hostInfo . $_SERVER['REQUEST_URI'], PHP_URL_PATH);
					header('Location: ' . $request_uri . '?' . http_build_query($new_get));
					exit;
				}
			}

			foreach (Yii::$app->params['cities'] as $code => $city) {
				if (strpos($_SERVER['HTTP_HOST'], $code . '.') === 0) {
					Yii::$app->params['city'] = $city;
					defined('SUBDOMAIN') or define('SUBDOMAIN', $code . '.');
				}
			}
		}

		//Если ничего не нашли то устанавливаем Нижний Новгород
		if (empty(Yii::$app->params['city'])) {
			Yii::$app->params['city'] = Yii::$app->params['cities']['nn'];
			defined('SUBDOMAIN') or define('SUBDOMAIN', '');
		}

		defined('CITY_ID') or define('CITY_ID', Yii::$app->params['city']['id']);
		defined('CITY_CODE') or define('CITY_CODE', Yii::$app->params['city']['code']);
		defined('CITY_NAME') or define('CITY_NAME', Yii::$app->params['city']['name']);

		if ($accessIsAllowed) {
			if (!empty($get['clear_all_cache'])) {
				Yii::$app->cache->flush();
				Yii::$app->response->redirect(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 301);
			}
			if (Yii::$app->params['city']['code'] == 'nn'
				&& parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/'
			) {
				if (empty($_COOKIE['region'])) {
					if (!empty($get['ip'])) {
						$ip = $get['ip'];
					} else {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
//$ip = '82.208.67.234';//test НН
//$ip = '188.162.36.110';//test2 Самара
					$region = Yii::$app->sypexGeo->getCityFull($ip);
					if (is_array($region)) {
						$geo_info = [
							'city' => $region['city']['name_ru'],
							'region' => $region['region']['name_ru'],
						];
					}
					if (!empty($geo_info['city']) && !empty($geo_info['region']) && $geo_info['city'] !== 'Нижний Новгород' && $geo_info['region'] !== 'Нижегородская область') {
						$city = City::find()
							->active()
							->where(['name' => $geo_info['city']])
							->one();
						if ($city) {
							Yii::$app->response->redirect(CF::server_protocol() . $city->code . '.' . Yii::$app->params['server_name'], 301);
						}
					}
				}
				if (!empty($get['ip'])) {
					return Yii::$app->response->redirect(CF::server_protocol() . Yii::$app->params['server_name'], 301);
				}
			}
		}
	}
}

