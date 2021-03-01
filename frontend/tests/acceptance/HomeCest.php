<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
       // $I->see('My Application');

        $I->seeLink('Контакты');
        $I->click('Контакты');
        $I->wait(2); // wait for page to be opened

        $I->see('Контакты');
    }
}
