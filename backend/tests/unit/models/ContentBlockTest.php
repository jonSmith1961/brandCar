<?php namespace backend\tests\models;

use backend\models\ContentBlock;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\ContentBlockFixture;

class ContentBlockTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = ContentBlock::className();

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
            'content-block' => [
                'class' => ContentBlockFixture::className(),
                'dataFile' => codecept_data_dir() . 'content-block.php'
            ],
	        'city' => [
		        'class' => CityFixture::className(),
		        'dataFile' => codecept_data_dir() . 'city.php'
	        ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new $this->className;

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new $this->className;

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
		$obj = new ContentBlock();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueContentBlock()
	{
		$model = new $this->className;
		$expectedAttrs = [
			'name' => 'test name', //	character varying(255)
			'active' => '1', //	integer
			'code' => 'test-content-block-11', //	character varying(255)
			'content' => '<p>text test content</p>', //	text
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

		$modelAfterSave = ContentBlock::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($modelAfterSave);

		$this->assertEquals($expectedAttrs['name'], $modelAfterSave->name);
		$this->tester->assertEquals($expectedAttrs['code'], $modelAfterSave->code);

		$this->assertEquals($expectedAttrs['active'], $modelAfterSave->active);
		$this->assertEquals($expectedAttrs['content'], $modelAfterSave->content);

	}

}