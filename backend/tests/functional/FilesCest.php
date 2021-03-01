<?php namespace backend\tests\functional;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class FilesCest
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
			'files' => [
				'class' => FilesFixture::className(),
				'dataFile' => codecept_data_dir() . 'files.php'
			]

		];
	}

	/**
	 * @param FunctionalTester $I
	 */
	public function showFiles(FunctionalTester $I)
	{
		$pageH1 = 'Файлы';

		$fields = [
			'ID',
			'Оригинальное название',
			'Тип',
			'Имя файла',
			'Ширина',
		];

		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/files/');

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
		$pageH1 = 'Файлы';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/files/');
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
			['link'=>"Оригинальное название"],
			['link'=>"Тип"],
			['link'=>"Имя файла"],
			['link'=>"Ширина"],
		];
	}



}
