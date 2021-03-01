<?php namespace backend\tests\models;

use backend\models\Departments;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\DealerCenterFixture;
use backend\tests\fixtures\DepartmentsFixture;

class DepartmentsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
        protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = Departments::className();

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
            'departments' => [
                'class' => DepartmentsFixture::className(),
                'dataFile' => codecept_data_dir() . 'departments.php'
            ],
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
		$model = new Departments();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Departments();

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
		$obj = new Departments();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueDepartments()
	{
		$model = new Departments();
		$expectedAttrs = [
			'name' => 'Название тест 2',
			'active' => 1,
			'center_id' => 1, //	integer
			'phone' => '+7 (232) 4-335-647', //	character varying(255)
			'email' => 'asdsd@sdfs.com', //	character varying(255)
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

		$departments = Departments::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($departments);

		$this->assertEquals($expectedAttrs['name'], $departments->name);
		$this->tester->assertEquals($expectedAttrs['name'], $departments->name);

		$this->assertEquals($expectedAttrs['phone'], $departments->phone);
		$this->assertEquals($expectedAttrs['email'], $departments->email);

	}

}