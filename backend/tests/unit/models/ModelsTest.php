<?php namespace backend\tests\models;

use backend\models\Models;
use backend\tests\fixtures\FilesFixture;
use backend\tests\fixtures\GalleriesFixture;
use backend\tests\fixtures\ModelsFixture;

class ModelsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
        protected $tester;
		protected $className;

	protected function _before()
	{

		$this->className = Models::className();

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
            'models' => [
                'class' => ModelsFixture::className(),
                'dataFile' => codecept_data_dir() . 'models.php'
            ],
	        'galleries' => [
		        'class' => GalleriesFixture::className(),
		        'dataFile' => codecept_data_dir() . 'galleries.php'
	        ],
	        'files' => [
		        'class' => FilesFixture::className(),
		        'dataFile' => codecept_data_dir() . 'files.php'
	        ],
        ];
    }

	public function testEmptyValues()
	{
		$model = new Models();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Models();

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
		$obj = new Models();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueModels()
	{
		$model = new Models();
		$expectedAttrs = [
			'name' => 'Название тест 2',
			'code' => 'testcodeu',
			'active' => 1,
			'menu_name' => 'Меню название', //	character varying(255)
			'title' => 'Заголовок тест', //	character varying(255)
			'brief' => 'Краткое описание', //	text
			'qualities' => '', //	text
			'text_middle' => '', //	text
			'text_preview' => '', //	text
			'text_col' => '', //	text
			'warranty_year' => '4', //	text
			'warranty_mileage' => '300 000', //	text
			'preview_picture' => 1, //	integer
			'detail_picture' => 2, //	integer
			'specifications_file' => 3, //	integer
			'catalog_file' => 4, //	integer
			'gallery1_id' => 1, //	integer
			'gallery2_id' => 1, //	integer
			'gallery3_id' => 1, //	integer
			'sort' => 1, //	integer
			'created_at' => '1392559490',
			'updated_at' => '1392559490',
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$models = Models::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($models);

		$this->assertEquals($expectedAttrs['name'], $models->name);
		$this->tester->assertEquals($expectedAttrs['name'], $models->name);

		$this->assertEquals($expectedAttrs['title'], $models->title);
		$this->assertEquals($expectedAttrs['code'], $models->code);

	}

}