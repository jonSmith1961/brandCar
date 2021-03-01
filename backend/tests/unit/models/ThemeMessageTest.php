<?php

namespace backend\tests\unit\models;


use Codeception\Test\Unit;
use backend\tests\UnitTester;
use Yii;


use backend\tests\fixtures\ThemeMessageFixture;
use backend\models\ThemeMessage;


class ThemeMessageTest extends Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

	public function _fixtures()
	{
		return [
			'theme' => [
				'class' => ThemeMessageFixture::class,
				'dataFile' => codecept_data_dir() . 'theme.php',
			],
		];
	}


	protected function _before()
    {
    }

    protected function _after()
    {
    }

	// tests
	public function testEmptyValues()
	{
//		sleep(20);

		$model = new ThemeMessage();

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}

	public function testNameOnly()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'name' => 'one title'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}

	public function testLongName()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('name');

	}


	public function testLongCode()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'code' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');

	}


	public function testLongThemeCrm()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'theme_crm' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();
		expect('key theme_crm must have in array errors', $model->errors)->hasKey('theme_crm');

	}



	public function testCodeOnly()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'code' => 'sale'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}

	public function testThemeCrmOnly()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'theme_crm' => 'тест тема'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}


	public function testNameAndCode()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'code' => 'sale',
			'name' => 'one title',
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}

	public function testThemeCrmAndCode()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'theme_crm' => 'тест тема',
			'code' => 'sale',
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}


	public function testNameAndThemeCrm()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'name' => 'one title',
			'theme_crm' => 'тест тема',
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();

	}


	public function testFieldActiveNotInteger()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'active' => 'string'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key active must have in array errors', $model->errors)->hasKey('active');

	}



	public function testWrongCode()
	{
		$model = new ThemeMessage();

		$model->attributes = [
			'code' => 'фываппав'
		];

		expect($model->validate())->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');

	}


	public function testNotUniqueCode()
	{
		$model = new ThemeMessage();

		$codeTest = 'sale-test';

		$model->attributes = [
			'code' => $codeTest,
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');
	}

	public function testTrueThemeMessage()
	{
		$model = new ThemeMessage();
		$expectedAttrs = [
			'name' => 'Сервис тест',
			'code' => 'service-test',
			'theme_crm' => 'Обратный звонок | Сервис тест',
			'active' => 1,
			'created_at' => '1492559490',
			'updated_at' => '1492559490',
		];

		$model->attributes = $expectedAttrs;

		expect('Validation should be success', $model->validate())->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$city = ThemeMessage::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($city);

		$this->assertEquals($expectedAttrs['name'], $city->name);
		$this->tester->assertEquals($expectedAttrs['name'], $city->name);

		$this->assertEquals($expectedAttrs['theme_crm'], $city->theme_crm);
		$this->assertEquals($expectedAttrs['code'], $city->code);

	}


}

/*
 *
 *
 *  [['name', 'code', 'theme_crm'], 'required'],
            [['active', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'code', 'theme_crm'], 'string', 'max' => 255],
            [['code'], 'unique'],
	        ['code', 'match', 'pattern' => '/^[a-z0-9.-]*$/', 'message' => 'В символьный код входят маленькие латинские буквы, цифры и тире'],
      */