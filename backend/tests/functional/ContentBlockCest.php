<?php namespace backend\tests\functional;
use backend\tests\fixtures\ContentBlockFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class ContentBlockCest
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
			'content-block' => [
				'class' => ContentBlockFixture::className(),
				'dataFile' => codecept_data_dir() . 'content-block.php'
			]
		];
	}

	/**
	 * @param FunctionalTester $I
	 */
	public function showContentBlock(FunctionalTester $I)
	{
		$pageH1 = 'Контент блоки';

		$fields = [
			'Название',
			'Символьный код',
			'Текст',
			'Активность',
			'Города',
		];

		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/content-block/');

		foreach ($fields as $field) {
			for ($i = 1; $i <= 2; $i++) {
				$I->click(['link' => $field]);
				$I->see($pageH1);
			}
		}
	}

	/**
	 * @param FunctionalTester $I
	 * @dataProvider pageProvider
	 */
	public function testSortLinkClick(FunctionalTester $I, Example $data)
	{
		$pageH1 = 'Контент блоки';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/content-block/');
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
			['link'=>"Текст"],
			['link'=>"Активность"],
			['link'=>"Города"],
		];
	}



}
