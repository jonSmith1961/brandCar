<?php
namespace frontend\tests\functional;

use backend\tests\fixtures\CityFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class AboutCest
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
			'city' => [
				'class' => CityFixture::className(),
				'dataFile' => codecept_data_dir() . 'city.php'
			]
		];
	}
    public function checkAbout(FunctionalTester $I)
    {

        $I->amOnRoute('/about');
        $I->see('О нас', 'h1');
    }
}
