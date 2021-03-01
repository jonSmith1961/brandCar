<?php namespace backend\tests;

use backend\models\Complectations;
use backend\tests\fixtures\ComplectationsFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\fixtures\ModelsFixture;

class ComplectationsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
        protected $tester;
        protected $className;

	protected function _before()
	{

		$this->className = Complectations::className();

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
            'complectations' => [
                'class' => ComplectationsFixture::className(),
                'dataFile' => codecept_data_dir() . 'complectations.php'
            ],
	        'files' => [
		        'class' => FilesFixture::className(),
		        'dataFile' => codecept_data_dir() . 'files.php'
	        ],
	        'models' => [
		        'class' => ModelsFixture::className(),
		        'dataFile' => codecept_data_dir() . 'models.php'
	        ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new Complectations();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Complectations();

		$model->attributes = [
			'name' => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();

	}
	public function testCodeOnly()
	{
		$model = new Complectations();

		$model->attributes = [
			'code' => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');

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
		$obj = new Complectations();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}


	/**
	 * @dataProvider providerStringFields
	 */
	public function testStringFieldsTrueSetEnglishText($a)
	{
		$model = new $this->className;

		$model->attributes = [
			$a => 'rdesrdRESRdtr'
		];

		expect('key '.$a.' must have not in array errors', $model->errors)->hasNotKey($a);

	}

	/**
	 * @return array
	 */
	public function providerStringFields()
	{
		$obj = new Complectations();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('string');
	}


	public function testPriceOnly()
	{
		$model = new Complectations();

		$model->attributes = [
			'price' => 'Название'
		];

//		$validate = $model->validate();


		expect('Validation should be failed', $model->validate())->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('price');

	}
	public function testPriceBelowZero()
	{
		$model = new Complectations();

		$model->attributes = [
			'price' => '-1'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('price');

	}

	public function testTrueComplectations()
	{
		$model = new Complectations();
		$expectedAttrs = [
			'name' => 'Название тест 2',
			'code' => 'testcode-u',
			'series' => 'nmr85-3-5-2', //	string
			'active' => 1,
			'created_at' => '1392559490',
			'updated_at' => '1392559490',

			//'id' => 2, //	integer
			'price' => '100500', //	character varying(255)
			'model_id' => 1, //	integer
			'title' => 'Заголовок', //	character varying(255)
			'brief' => 'фцвыауваыцвы', //	text
			'qualities' => '', //	text
			'preview_picture' => 1, //	integer
			'detail_picture' => 2, //	integer
			'specifications_file' => 3, //	integer
			'weight' => 3500, //	integer
			'sort' => 1, //	integer
		];

		$model->attributes = $expectedAttrs;
		$validate = $model->validate();
		foreach ($expectedAttrs as $key => $expectedAttr) {
			$model->$key = $expectedAttr;
		}
		$model->save();


		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$complectations = Complectations::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($complectations);

		$this->assertEquals($expectedAttrs['name'], $complectations->name);
		$this->tester->assertEquals($expectedAttrs['name'], $complectations->name);

		$this->assertEquals($expectedAttrs['series'], $complectations->series);
		$this->assertEquals($expectedAttrs['code'], $complectations->code);

	}

}