<?php
namespace backend\tests\functional;

use Codeception\Example;
use common\fixtures\UserFixture;
use backend\models\ThemeMessage;
use backend\tests\FunctionalTester;
use backend\tests\fixtures\ThemeMessageFixture;

class ThemeMessageCest
{

	public $pageAlias;
	public $className;
	public $urlPage;
	public $pageH1;
	public $urlViewPart;
	public $urlUpdatePart;
	public $titleViewPart;
	public $titleUpdatePart;

    public function _before(FunctionalTester $I)
    {
	    $pageAlias = 'theme-message';

	    $this->pageH1 = 'Темы сообщений';

	    $this->pageAlias = $pageAlias;
	    $this->urlPage = '/admin/'.$pageAlias.'/';
	    $this->className = ThemeMessage::className();
	    $this->urlViewPart = '/admin/'.$pageAlias.'/view';
	    $this->urlUpdatePart = '/admin/'.$pageAlias.'/update';
	    $this->titleViewPart = 'Просмотр темы сообщений: ';
	    $this->titleUpdatePart = 'Изменение темы сообщений: ';
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
			'theme' => [
				'class' => ThemeMessageFixture::className(),
				'dataFile' => codecept_data_dir() . 'theme.php'
			]
		];
	}

	/**
	 * @param FunctionalTester $I
	 * @dataProvider pageProvider
	 */
	public function testSortLinkClick(FunctionalTester $I, Example $data)
	{
		$I->amLoggedInAs(1);

		$I->amOnPage($this->urlPage);
		$I->see($this->pageH1, 'h1');
		$I->click(['link' => $data['link']]);
		$I->see($this->pageH1, 'h1');
		$I->seeInTitle($this->pageH1);
		$I->click(['link' => $data['link']]);
		$I->see($this->pageH1, 'h1');
		$I->seeInTitle($this->pageH1);
	}

	/**
	 * @return array
	 */
	protected function pageProvider()
	{
		return [
			['link'=>"Название"],
			['link'=>"Символьный код"],
			['link'=>"Причина обращения"],
			['link'=>"Активность"],
		];
	}

	/**
	 * @param FunctionalTester $I
	 */
	public function viewThemeMessage(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = $this->className::find()->one();

		$urlView = $this->urlViewPart.'/'.$model->id.'/';
		$urlUpdate = $this->urlUpdatePart.'/'.$model->id.'/';
		$titleView = $this->titleViewPart.''. $model->name;
		$titleUpdate = $this->titleUpdatePart.''. $model->name;

		$I->amOnPage($urlView);
		$I->see($titleView);
		$I->click(['link' => 'Изменить']);

		$I->amOnPage($urlUpdate);
		$I->see($titleUpdate);
		$I->click('Сохранить');

	}

	/**
	 * @param FunctionalTester $I
	 */
	public function updateThemeMessage(FunctionalTester $I)
	{
		$I->amLoggedInAs(1);

		$model = $this->className::find()->one();

		$urlView = $this->urlViewPart.'/'.$model->id.'/';
		$urlUpdate = $this->urlUpdatePart.'/'.$model->id.'/';
		$titleView = $this->titleViewPart.''. $model->name;
		$titleUpdate = $this->titleUpdatePart.''. $model->name;

		$I->amOnPage($urlUpdate);
		$I->see($titleUpdate);
		$I->click('Сохранить');

		$I->amOnPage($urlView);
		$I->see($titleView);
		$I->click(['link' => 'Изменить']);

	}
}
