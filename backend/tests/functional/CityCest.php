<?php namespace backend\tests\functional;
use backend\models\City;
use backend\tests\fixtures\CityFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class CityCest
{
    public function _before(FunctionalTester $I)
    {
    }

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
			],
			'city' => [
				'class' => CityFixture::className(),
				'dataFile' => codecept_data_dir() . 'city.php'
			]

		];
	}

	/**
	 * @param FunctionalTester $I
	 * @dataProvider pageProvider
	 */
	public function testSortLinkClick(FunctionalTester $I, Example $data)
	{
		$pageH1 = 'Города';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/city/');
		$I->see($pageH1, 'h1');
		$I->click(['link' => $data['link']]);
		$I->see($pageH1, 'h1');
		$I->seeInTitle($pageH1);
		$I->click(['link' => $data['link']]);
		$I->see($pageH1, 'h1');
		$I->seeInTitle($pageH1);

	}

	/**
	 * @return array
	 */
	protected function pageProvider()
	{
		return [
			['link'=>"Название"],
			['link'=>"Символьный код"],
			['link'=>"Телефон"],
			['link'=>"Активность"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function createCity(FunctionalTester $I)
	{

		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/city/create/');
		$I->fillField('City[name]', 'Город Город');
		$I->fillField('City[code]', 'codecity');
		$I->fillField('City[phone]', '+7 (132) 4-542-132');
		$I->click('Сохранить');

		$I->see('Город Город');

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function viewCity(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = City::find()->one();

		$urlView = '/admin/city/view/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateCity(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = City::find()->one();

		$urlView = '/admin/city/update/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
