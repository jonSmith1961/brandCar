<?php namespace backend\tests\functional;
use backend\models\Galleries;
use backend\tests\fixtures\GalleriesFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class GalleriesCest
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
			'galleries' => [
				'class' => GalleriesFixture::className(),
				'dataFile' => codecept_data_dir() . 'galleries.php'
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
		$pageH1 = 'Галереи';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/galleries/');
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
			['link'=>"Заголовок"],
			['link'=>"Группа"],
			['link'=>"Код"],
			['link'=>"Активность"],
			['link'=>"Город"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewGalleries(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Galleries::find()->one();

		$urlView = '/admin/galleries/view/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateGalleries(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Galleries::find()->one();

		$urlView = '/admin/galleries/update/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
