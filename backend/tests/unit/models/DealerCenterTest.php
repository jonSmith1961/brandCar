<?php namespace backend\tests\models;

use backend\models\DealerCenter;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\DealerCenterFixture;

class DealerCenterTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
     protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = DealerCenter::className();

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
            'dealer-center' => [
                'class' => DealerCenterFixture::className(),
                'dataFile' => codecept_data_dir() . 'dealer-center.php'
            ],
	        'city' => [
		        'class' => CityFixture::className(),
		        'dataFile' => codecept_data_dir() . 'city.php'
	        ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new DealerCenter();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new DealerCenter();

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
		$obj = new DealerCenter();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}


	public function testTrueDealerCenter()
	{
		$model = new DealerCenter();
		$expectedAttrs = [
			'name' => 'Название тест 2',
			'active' => 1,
			'city_id' => 1, //	integer
			'phone' => '+7 (232) 4-335-647', //	character varying(255)
			'email' => 'asdsd@sdfs.com', //	character varying(255)
			'address' => 'Адрес', //	character varying(255)
			'post_code' => '603000', //	character varying(255)
			'latitude' => '56.235290', //	character varying(255)
			'longitude' => '44.235290', //	character varying(255)
			'map_link' => '', //	character varying(255)
			'start_time' => '08:00', //	character varying(255)
			'end_time' => '18:00', //	character varying(255)
			'start_time_saturday' => '', //	character varying(255)
			'end_time_saturday' => '', //	character varying(255)
			'start_time_sunday' => '', //	character varying(255)
			'end_time_sunday' => '', //	character varying(255)
			'start_time_holidays' => '', //	character varying(255)
			'end_time_holidays' => '', //	character varying(255)
			'created_at' => '1392559490',
			'updated_at' => '1392559490',
		];

		$model->attributes = $expectedAttrs;

		expect('Validation should be success', $model->validate())->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$dealerCenter = DealerCenter::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($dealerCenter);

		$this->assertEquals($expectedAttrs['name'], $dealerCenter->name);
		$this->tester->assertEquals($expectedAttrs['name'], $dealerCenter->name);

		$this->assertEquals($expectedAttrs['phone'], $dealerCenter->phone);
		$this->assertEquals($expectedAttrs['email'], $dealerCenter->email);

	}

}