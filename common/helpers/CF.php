<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 23.06.2020
 * Time: 16:03
 */

namespace common\helpers;


use common\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\console\Application as ConsoleApplication;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseJson;
use yii\helpers\Html;
use yii\web\ServerErrorHttpException;

class CF
{
	public static function p($data)
	{
		if (Yii::$app->user->identity->isAdmin()) {
			if (is_bool($data)) {
				$data = ($data ? 'true' : 'false');
			}
			echo '<pre>' . print_r($data, 1) . '</pre>';
		}
	}

	public static function printError($model, $data)
	{

		$attributeLabels = $model->attributeLabels();

		if (Yii::$app->user->identity->isAdmin()) {
			if (is_bool($data)) {
				$data = ($data ? 'true' : 'false');
			}
			echo '<pre>';
			foreach ($data as $key => $rows) {
				$attributeName = ArrayHelper::getValue( $attributeLabels, $key);
				foreach ($rows as $row) {
					echo 'Ошибка! Поле: '.$attributeName. ' - '. $row . ' <a  href="#'.$key.'"> --> #</a><br>';
				}

			}
			echo '</pre>';

		}
	}

	public static function server_protocol()
	{
		if (Yii::$app instanceof ConsoleApplication) {
			return YII_ENV_DEV ? 'http://' : 'https://';
		}
		return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	}

	public static function domain()
	{
		return self::server_protocol() . Yii::$app->request->hostName;
	}

	public static function numberFormat($number, int $decimals = null)
	{
		$explode = explode('.', $number);
		if (!empty($explode[1]) && $explode[1] > 0) {
			if (!empty($decimals)) {
				return number_format($number, $decimals, '.', ' ');
			} else {
				return number_format($number, strlen($explode[1]), '.', ' ');
			}
		} else {
			if (!empty($decimals)) {
				return number_format($number, $decimals, '.', ' ');
			} else {
				return number_format($number, 0, '.', ' ');
			}
		}
	}

	/**
	 * Вызов selectpicker при использовании websocket.
	 */
	public static function selectpicker()
	{
		echo Html::script('$(".selectpicker").selectpicker()');
	}

	/**
	 * Опции для selectpicker.
	 *
	 * @param bool|bool $multiple Множественный выбор
	 * @param null|string $prompt Ничего не выбрано
	 * @param bool $liveSearch Поиск
	 * @param bool $actionsBox Выбрать все
	 * @param int $count Макс. количество в строке
	 *
	 * @return string[]
	 */
	public static function getSelectpickerOptions($multiple = false, $prompt = false, $liveSearch = false, $actionsBox = false, $count = 3)
	{
		$options = [
			'class' => 'selectpicker form-control',
		];

		if (is_null($prompt)) {
			$options['prompt'] = 'Не выбрано';
		} elseif (is_string($prompt)) {
			$options['prompt'] = $prompt;
		}
		if ($liveSearch) {
			$options['data-live-search'] = 'true';
		}
		if ($actionsBox) {
			$options['data-actions-box'] = 'true';
		}
		if ($multiple) {
			$options['multiple'] = 'true';
			$options['data-selected-text-format'] = 'count>' . $count;
		}

		return $options;
	}

	/**
	 * @param integer $n
	 * @param array $forms [0 => значений, 1 => значение, 2 => значения]
	 * @param bool $withN
	 *
	 * @return mixed
	 */
	public static function plural($n, $forms, $withN = false)
	{
		$result = $n % 10 == 1 && $n % 100 != 11 ? $forms[1] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[2] : $forms[0]);
		if ($withN) {
			$result = $n . ' ' . $result;
		}
		return $result;
	}

	public static function getClassName($class)
	{
		return explode('\\', $class)[2];
	}

	/**
	 * Сортировка массива по нужному ключу.
	 *
	 * @param string $sort
	 * @param array $array
	 */
	public static function sortBy(string $sort, array &$array)
	{
		uasort($array, function ($a, $b) use ($sort) {
			if ($a[$sort] > $b[$sort]) return 1;
		});
	}

	/**
	 * Получить номер вида +7(999) 999-99-99
	 *
	 * @param string $phone
	 *
	 * @return string|string[]|null
	 */
	public static function getPhoneWithoutSpace(string $phone)
	{
		$number = preg_replace('/\D+/', '', $phone);
		if (strlen($number) === 10) {
			$result = preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', "+7($1) $2-$3-$4", $number);
		} elseif (strlen($number) === 11) {
			$result = preg_replace('/(\d)(\d{3})(\d{3})(\d{2})(\d{2})/', "+7($2) $3-$4-$5", $number);
		} else {
			$result = null;
		}
		return $result;
	}

	/**
	 * Получить номер вида +7 (999) 999-99-99
	 *
	 * @param string $phone
	 *
	 * @return string|string[]|null
	 */
	public static function getPhoneWithSpace(string $phone)
	{
		$number = preg_replace('/\D+/', '', $phone);
		if (strlen($number) === 10) {
			$result = preg_replace('/(\d{3})(\d{3})(\d{2})(\d{2})/', "+7 ($1) $2-$3-$4", $number);
		} elseif (strlen($number) === 11) {
			$result = preg_replace('/(\d)(\d{3})(\d{3})(\d{2})(\d{2})/', "+7 ($2) $3-$4-$5", $number);
		} else {
			$result = null;
		}
		return $result;
	}

	/**
	 * Доп поля для проверки на спам.
	 * @return string
	 */
	public static function antispamFields(): string
    {
        return Html::input('text', 'name', '', ['class' => 'no-visible'])
            . Html::input('text', 'phone', '', ['class' => 'no-visible']);
    }

	/**
	 * Преобразование объекта класса stdClass в массив
	 * @param $value
	 * @return mixed
	 */
	public static function stdClassDecode($value)
    {

	    if(is_object($value)){
		    $value = json_decode(json_encode($value), true);
	    } elseif(is_array($value)){
		    $value = json_decode(json_encode($value), true);
	    } elseif(is_string($value)){
		    $value = json_decode($value);
	    }

        return $value;
    }
}