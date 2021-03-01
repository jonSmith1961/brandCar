<?php namespace backend\tests\models;

use backend\models\Recipient;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\DealerCenterFixture;
use backend\tests\fixtures\RecipientFixture;
use backend\tests\fixtures\ThemeMessageFixture;

class RecipientTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
        protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = Recipient::className();

	}


	protected function _after()
	{
	}

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'recipient' => [
                'class' => RecipientFixture::className(),
                'dataFile' => codecept_data_dir() . 'recipient.php'
            ],
	        'dealer-center' => [
		        'class' => DealerCenterFixture::className(),
		        'dataFile' => codecept_data_dir() . 'dealer-center.php'
	        ],
	        'city' => [
		        'class' => CityFixture::className(),
		        'dataFile' => codecept_data_dir() . 'city.php'
	        ],
	        'theme' => [
		        'class' => ThemeMessageFixture::class,
		        'dataFile' => codecept_data_dir() . 'theme.php',
	        ],
        ];
    }

	public function testEmptyValues()
	{
		$model = new Recipient();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Recipient();

		$model->attributes = [
			'name' => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();

	}

	/**
	 * @dataProvider providerIntegerFields
	 */
	public function testIntegerFieldsWrongSetRussianText($a)
	{
		$model = new $this->className;

		$model->attributes = [
			$a => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key '.$a.' must have in array errors', $model->errors)->hasKey($a);

	}

	/**
	 * @return array
	 */
	public function providerIntegerFields()
	{
		$obj = new Recipient();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueRecipient()
	{
		$model = new Recipient();
		$expectedAttrs = [
			'center_id' => 1,
			'city_id' => 1,
			'theme_id' => 1,
			'recipient' => 'recipient2 recipient2 recipient3',
			'active' => 1,
			'created_at' => '1392559490',
			'updated_at' => '1392559490',
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$recipient = Recipient::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($recipient);

		$this->assertEquals($expectedAttrs['center_id'], $recipient->center_id);
		$this->tester->assertEquals($expectedAttrs['center_id'], $recipient->center_id);

		$this->assertEquals($expectedAttrs['city_id'], $recipient->city_id);
		$this->assertEquals($expectedAttrs['recipient'], $recipient->recipient);

	}

}