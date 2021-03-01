<?php namespace backend\tests\functional;
use backend\models\Recipient;
use backend\tests\fixtures\RecipientFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class RecipientCest
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
			'recipient' => [
				'class' => RecipientFixture::className(),
				'dataFile' => codecept_data_dir() . 'recipient.php'
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
		$pageH1 = 'Получатели';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/recipient/');
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
			['link'=>"Тема"],
			['link'=>"Город"],
			['link'=>"Дилерский центр"],
			['link'=>"Получатели"],
			['link'=>"Активность"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewRecipient(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Recipient::find()->one();

		$urlView = '/admin/recipient/view/'.$model->id.'/';
		$title = 'Просмотр группы получателей ' . $model->id;

		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($title);
	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateRecipient(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Recipient::find()->one();

		$urlView = '/admin/recipient/update/'.$model->id.'/';
		$title = 'Изменение группы получателей ' . $model->id;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($title);
	}
}
