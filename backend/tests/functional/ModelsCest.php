<?php namespace backend\tests\functional;
use backend\models\Models;
use backend\tests\fixtures\ModelsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class ModelsCest
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
			'models' => [
				'class' => ModelsFixture::className(),
				'dataFile' => codecept_data_dir() . 'models.php'
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
		$pageH1 = 'Модели';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/models/');
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
			['link'=>"Название в меню"],
			['link'=>"Заголовок"],
			['link'=>"Символьный код"],
			['link'=>"Превью"],
			['link'=>"Порядок"],
			['link'=>"Активность"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewModels(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Models::find()->one();

		$urlView = '/admin/models/view/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateModels(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Models::find()->one();

		$urlView = '/admin/models/update/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
