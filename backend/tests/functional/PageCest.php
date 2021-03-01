<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class PageCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    /**
     * @param FunctionalTester $I
     * @dataProvider pageProvider
     */
    public function testPageH1(FunctionalTester $I, Example $data)
    {

	    $I->amLoggedInAs(1);

	    $I->amOnPage($data['url']);
	    $I->see($data['title'], 'h1');
	    $I->seeInTitle($data['title']);

    }

	/**
	 * @return array
	 */
	protected function pageProvider()
	{
		return [
			['url'=>"/admin/specials/", 'title'=>"Акции"],
			['url'=>"/admin/specials/create/", 'title'=>"Создание акции"],
			['url'=>"/admin/galleries/", 'title'=>"Галереи"],
			['url'=>"/admin/galleries/create/", 'title'=>"Создать галерею"],
			['url'=>"/admin/city/", 'title'=>"Города"],
			['url'=>"/admin/city/create/", 'title'=>"Создать город"],
			['url'=>"/admin/dealer-center/", 'title'=>"Дилерские центры"],
			['url'=>"/admin/dealer-center/create/", 'title'=>"Создание Дилерского центра"],
			['url'=>"/admin/departments/", 'title'=>"Отделы"],
			['url'=>"/admin/departments/create/", 'title'=>"Создание отдела"],
			['url'=>"/admin/theme-message/", 'title'=>"Темы сообщений"],
			['url'=>"/admin/theme-message/create/", 'title'=>"Создать Тему сообщения"],
			['url'=>"/admin/recipient/", 'title'=>"Получатели"],
			['url'=>"/admin/recipient/create/", 'title'=>"Создать группу получателей"],
			['url'=>"/admin/complectations/", 'title'=>"Комплектации"],
			['url'=>"/admin/complectations/create/", 'title'=>"Создать комплектацию"],
			['url'=>"/admin/models/", 'title'=>"Модели"],
			['url'=>"/admin/models/create/", 'title'=>"Создать модель"],
			['url'=>"/admin/news/", 'title'=>"Новости"],
			['url'=>"/admin/news/create/", 'title'=>"Создание новости"],
			['url'=>"/admin/content-block/", 'title'=>"Контент блоки"],
			['url'=>"/admin/content-block/create/", 'title'=>"Создать контент блок"],
			['url'=>"/admin/files/", 'title'=>"Файлы"],
		];
	}
}
