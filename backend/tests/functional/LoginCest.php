<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Example;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
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
            ]
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {

        $I->amOnPage('/admin/login/');
        $I->fillField('LoginForm[email]', 'sfriesen@jenkins.info');
        $I->fillField('LoginForm[password]', 'password_0');
        $I->click('login-button');

        $I->see('Выйти (erau)');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
