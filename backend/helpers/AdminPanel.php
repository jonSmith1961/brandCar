<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 23.06.2020
 * Time: 10:29
 */

namespace backend\helpers;


use common\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class AdminPanel
{
	public static function main_menu_items()
	{
		/** @var User $user */
		$user = Yii::$app->user;
		$menu_items = [
			[
				'label' => 'Главная',
				'url' => ['/site/index']
			],
			'<li>' . Html::a('Сайт', '/', ['target' => '_blank']) . '</li>',
		];

		if ($user->identity->isAdmin()) {
			$menu_items_user_roles = [
				'label' => 'Группы',
				'url' => ['/user/roles'],
				'options' => ['class' => 'dropdown-submenu'],
			];
			$menu_items_user_permission = [
				'label' => 'Разрешения',
				'url' => ['/user/permission'],
				'options' => ['class' => 'dropdown-submenu'],
			];
		} else {
			$menu_items_user_roles = '';
			$menu_items_user_permission = '';
		}

		if ($user->identity->isAdmin()) {
			$menu_items[] = [
				'label' => 'Пользователи',
				'url' => ['/user'],
				'items' => [
					[
						'label' => 'Список пользователей',
						'url' => ['/user/index'],
						'options' => ['class' => 'dropdown-submenu'],
					],
					$menu_items_user_roles,
					$menu_items_user_permission
				]
			];
		}

		if ($user->can('gii')) {
			$menu_items[] = '<li>' . Html::a('Конструктор gii', '/gii', ['target' => '_blank']) . '</li>';
		}

		$menu_items[] = [
			'label' => 'Выйти (' . $user->identity->username . ')',
			'url' => ['/site/logout']
		];

		return $menu_items;
	}

	public static function mainMenuItems()
	{
		return Yii::$app->cache->getOrSet('admin_menu', function () {

			$contactItems = [
				[
					'label' => 'Города',
					'url' => ['/city'],
				],
				[
					'label' => 'Диллерские центры',
					'url' => ['#'],
					'items' => [
						[
							'label' => 'Центры',
							'url' => ['/dealer-center'],
						],
						[
							'label' => 'Отделы',
							'url' => ['/departments'],
						],
					],
				],
				[
					'label' => 'Получатели писем',
					'url' => ['#'],
					'items' => [
						[
							'label' => 'Темы обращений',
							'url' => ['/theme-message'],
						],
						[
							'label' => 'Список получателей',
							'url' => ['/recipient'],
						],
					],
				],
			];
			$specialItems = [
				[
					'label' => 'Список акций',
					'url' => ['/specials'],
				],
			];
			$newsItems = [
				[
					'label' => 'Список новостей',
					'url' => ['/news'],
				],
			];
			$menu_items[] = [

				'label' => 'Модельный ряд',
				'url' => ['#'],
				'items' => [
					[
						'label' => 'Модели',
						'url' => ['/models'],
					],
					[
						'label' => 'Комплектации',
						'url' => ['/complectations'],
					],
				],

			];

			$menu_items[] = [
				'label' => 'Контакты',
				'items' => $contactItems,
			];
			$menu_items[] = [
				'label' => 'Акции',
				'items' => $specialItems,
			];
			$menu_items[] = [
				'label' => 'Новости',
				'items' => $newsItems,
			];


			$menu_items[] = [

				'label' => 'Файлы',
				'url' => ['#'],
				'items' => [
					[
						'label' => 'Список файлов',
						'url' => ['/files'],
					],
					[
						'label' => 'Контент блоки',
						'url' => ['/content-block'],
					],
				],

			];

			$menu_items[] = [

				'label' => 'Галлереи',
				'url' => ['#'],
				'items' => [
					[
						'label' => 'Список галерей',
						'url' => ['/galleries'],
					],
				],

			];

			$currentPath = Yii::$app->request->baseUrl . '/' . Yii::$app->request->pathInfo;
			$menu_items = array_map(function ($item) use ($currentPath) {
				if (!empty($item['url']) && $currentPath == Url::toRoute($item['url'])) {
					$item['active'] = true;
				}
				if (is_array($item) && isset($item['items'])) {
					usort($item['items'], function ($a, $b) {
						return $a['label'] <=> $b['label'];
					});

					foreach ($item['items'] as $i => $oneItem) {
						if ($currentPath == (Url::toRoute($oneItem['url']) ?? false)) {
							$item['active'] = true;
							$item['items'][$i]['active'] = true;
						}
						if (isset($oneItem['items'])) {
							foreach ($oneItem['items'] as $k => $subItem) {
								if ($currentPath == (Url::toRoute($subItem['url']) ?? false)) {
									$item['active'] = true;
									$item['items'][$i]['active'] = true;
								}
							}
						}
					}
				}
				return $item;
			}, $menu_items);
			usort($menu_items, function ($a, $b) {
				return $a['label'] <=> $b['label'];
			});
			return $menu_items;
		}, 1);
	}
}