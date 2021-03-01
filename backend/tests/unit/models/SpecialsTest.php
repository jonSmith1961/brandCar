<?php namespace backend\tests\models;

use backend\models\Specials;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\fixtures\SpecialsFixture;

class SpecialsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
	protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = Specials::className();

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
            'specials' => [
                'class' => SpecialsFixture::className(),
                'dataFile' => codecept_data_dir() . 'specials.php'
            ],
	        'files' => [
		        'class' => FilesFixture::className(),
		        'dataFile' => codecept_data_dir() . 'files.php'
	        ],
	        'city' => [
		        'class' => CityFixture::className(),
		        'dataFile' => codecept_data_dir() . 'city.php'
	        ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new Specials();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Specials();

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
		expect('key name must have in array errors', $model->errors)->hasKey($a);

	}

	/**
	 * @return array
	 */
	public function providerIntegerFields()
	{
		$obj = new Specials();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}


	public function testTrueSpecials()
	{
		$model = new Specials();
		$expectedAttrs = [
			'active' => 1,
			'alias' => 'adsfus', //	character varying(255)
			'title' => 'Заголовок тест 2', //	character varying(255)
			'brief' => 'Тест описание краткое', //	text
			'text' => 'Основной текст', //	text
			'sub_title' => 'Подзаголовок', //	text
			'url' => 'werfdfsu', //	character varying(255)
			'sort' => 1, //	integer
			'preview_picture' => 1, //	integer
			'detail_picture' => 2, //	integer
			'created_at' => '1392559490',
			'updated_at' => '1392559490',
			'citiesField' => 1,
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$specials = Specials::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($specials);

		$this->assertEquals($expectedAttrs['title'], $specials->title);
		$this->tester->assertEquals($expectedAttrs['title'], $specials->title);

		$this->assertEquals($expectedAttrs['brief'], $specials->brief);
		$this->assertEquals($expectedAttrs['alias'], $specials->alias);

	}
}