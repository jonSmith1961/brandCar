<?php namespace backend\tests\functional;
use backend\models\Complectations;
use backend\tests\fixtures\ComplectationsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class ComplectationsCest
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
			'complectations' => [
				'class' => ComplectationsFixture::className(),
				'dataFile' => codecept_data_dir() . 'complectations.php'
			],
			'files' => [
				'class' => FilesFixture::className(),
				'dataFile' => codecept_data_dir() . 'files.php'
			]

		];
	}

	/**
	 * @param FunctionalTester $I
	 * @dataProvider pageProvider
	 */
	public function testSortLinkClick(FunctionalTester $I, Example $data)
	{
		$pageH1 = 'Комплектации';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/complectations/');
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
			['link'=>"Цена"],
			['link'=>"Модель"],
			['link'=>"Заголовок"],
			['link'=>"Серия"],
			['link'=>"Превью"],
			['link'=>"Масса"],
			['link'=>"Порядок"],
			['link'=>"Активность"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewComplectations(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Complectations::find()->one();

		$urlView = '/admin/complectations/view/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateComplectations(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Complectations::find()->one();

		$urlView = '/admin/complectations/update/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
