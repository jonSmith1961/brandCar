<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class AaPageCest
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
			['url'=>"/specials/", 'title'=>"Акции"],
			//['url'=>"/models/elf/", 'title'=>"<span>Малотоннажные грузовики серия ELF</span>"],
			['url'=>"/news/", 'title'=>"Новости"],
		];
	}
}
