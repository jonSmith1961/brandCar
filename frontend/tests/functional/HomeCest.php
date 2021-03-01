<?php

namespace frontend\tests\functional;

use backend\tests\fixtures\CityFixture;
use frontend\tests\FunctionalTester;
use Yii;

class HomeCest
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

    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(Yii::$app->homeUrl);
        $I->see('My Application');
        $I->seeLink('About');
        $I->click('About');
        $I->see('This is the About page.');
    }
}