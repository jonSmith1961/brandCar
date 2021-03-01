<?php namespace backend\tests\functional;
use backend\models\Departments;
use backend\tests\fixtures\DepartmentsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

class DepartmentsCest
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
			'departments' => [
				'class' => DepartmentsFixture::className(),
				'dataFile' => codecept_data_dir() . 'departments.php'
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
		$pageH1 = 'Отделы';
		$I->amLoggedInAs(1);

		$I->amOnPage('/admin/departments/');
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
			['link'=>"Дилерский центр"],
			['link'=>"Телефон"],
			['link'=>"Активность"],
		];
	}



	/**
	 * @param FunctionalTester $I
	 */
	public function viewDepartments(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Departments::find()->one();

		$urlView = '/admin/departments/view/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click(['link' => 'Изменить']);

		$I->see($name);

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateDepartments(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = Departments::find()->one();

		$urlView = '/admin/departments/update/'.$model->id.'/';
		$name = $model->name;
		$I->amOnPage($urlView);
		$I->click('Сохранить');

		$I->see($name);

	}
}
