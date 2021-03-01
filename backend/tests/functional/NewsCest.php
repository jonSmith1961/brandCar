<?php namespace backend\tests\functional;
use backend\models\News;
use backend\tests\fixtures\NewsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class NewsCest
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
			'news' => [
				'class' => NewsFixture::className(),
				'dataFile' => codecept_data_dir() . 'news.php'
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
		$pageH1 = 'Новости';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/news/');
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
			['link'=>"Символьный код"],
			['link'=>"Заголовок"],
			['link'=>"Дата"],
			['link'=>"Активность"],
			['link'=>"Превью"],
			['link'=>"Города"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewNews(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = News::find()->one();

		$urlView = '/admin/news/view/'.$model->id.'/';
		$name = $model->title;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateNews(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = News::find()->one();

		$urlView = '/admin/news/update/'.$model->id.'/';
		$name = $model->title;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
