<?php namespace backend\tests\functional;
use backend\models\Specials;
use backend\tests\fixtures\SpecialsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class SpecialsCest
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
			'specials' => [
				'class' => SpecialsFixture::className(),
				'dataFile' => codecept_data_dir() . 'specials.php'
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
		$pageH1 = 'Акции';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/specials/');
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
			['link'=>"ID"],
			['link'=>"Заголовок"],
			['link'=>"Символьный код"],
			['link'=>"Анонс"],
			['link'=>"Превью"],
			['link'=>"Город"],
			['link'=>"Активность"],
			['link'=>"url"],
			['link'=>"Сортировка"],
		];
	}


	/**
	 * @param FunctionalTester $I
	 */
	public function viewSpecials(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Specials::find()->one();

		$urlView = '/admin/specials/view/'.$model->id.'/';
		$urlUpdate = '/admin/specials/update/'.$model->id.'/';
		$title1 = 'Просмотр акции: ' . $model->title;
		$title2 = 'Изменение акции: ' . $model->title;
		$I->amOnPage($urlView);
		$I->see($title1);
		$I->click(['link' => 'Изменить']);
		$I->amOnPage($urlUpdate);
		$I->see($title2);
		$I->click('Сохранить');
		$I->see($title1);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateSpecials(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Specials::find()->one();

		$urlView = '/admin/specials/view/'.$model->id.'/';
		$urlUpdate = '/admin/specials/update/'.$model->id.'/';
		$titleView = 'Просмотр акции: ' . $model->title;
		$titleUpdate = 'Изменение акции: ' . $model->title;

		$I->amOnPage($urlUpdate);
		$I->see($titleUpdate);
		$I->click('Сохранить');
		$I->amOnPage($urlView);
		$I->see($titleView);

	}
}
