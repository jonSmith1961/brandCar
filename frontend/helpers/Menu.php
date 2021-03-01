<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 13.07.2020
 * Time: 9:04
 */

namespace frontend\helpers;


use backend\models\City;
use backend\models\Models;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Menu extends Widget
{
	public function run()
	{
		$guestItems = [
			[
				'label' => 'Контакты',
				'url' => Url::toRoute(['/contacts']),
			],
			[
				'label' => 'Обратная связь',
				'url' => Url::toRoute(['contacts/feedback']),
			],
			[
				'label' => 'О компании',
				'url' => Url::toRoute(['/about']),
			],
		];

//		$userItems = [
//			[
//				'label' => 'Главная',
//				'url' => '/'
//			],
//		];
//
//		$moderItems = [
//			[
//				'label' => 'Главная',
//				'url' => '/'
//			],
//		];

		$menuItems = $guestItems;

//		$user = Yii::$app->user;
//
//		if ($user->isGuest) {
//			$menuItems = $guestItems;
//		} else {
//			if ($user->can('user')) {
//				$menuItems = $userItems;
//			} else {
//				$menuItems = $moderItems;
//			}
//		}

		$models = Models::find()->active()->orderBy(['sort' => SORT_ASC])->all();
		$currentCity = City::getCurrentCity();


		echo $this->render('/layouts/_top-menu', compact('menuItems', 'currentCity', 'models'));
	}
}