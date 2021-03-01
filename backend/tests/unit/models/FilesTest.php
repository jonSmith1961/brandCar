<?php namespace backend\tests\models;

use backend\models\Files;
use backend\tests\fixtures\FilesFixture;

class FilesTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
	protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = Files::className();

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
            'files' => [
                'class' => FilesFixture::className(),
                'dataFile' => codecept_data_dir() . 'files.php'
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
			'name' => 'dsfsad'
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
		$obj = new Files();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueNews()
	{
		$model = new $this->className;
		$expectedAttrs = [
			'original_name' => 'forward-banner-22', //	character varying(255)
			'type' => 'image/jpeg', //	character varying(255)
			'filename' => '75e1e4aa250374f28f73386d68d21e23.jpg', //	character varying(255)
			'width' => 30, //	integer
			'height' => 40, //	integer
			'size' => 23245, //	integer
			'created_at' => '1392559490',
			'updated_at' => '1392559490',
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$news = Files::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($news);

		$this->assertEquals($expectedAttrs['filename'], $news->filename);
		$this->tester->assertEquals($expectedAttrs['original_name'], $news->original_name);

		$this->assertEquals($expectedAttrs['size'], $news->size);
		$this->assertEquals($expectedAttrs['type'], $news->type);

	}
}