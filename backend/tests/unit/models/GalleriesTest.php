<?php namespace backend\tests\models;

use backend\models\Galleries;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\GalleriesFixture;

class GalleriesTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
        protected $tester;

	protected function _before()
	{
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
            'galleries' => [
                'class' => GalleriesFixture::className(),
                'dataFile' => codecept_data_dir() . 'galleries.php'
            ],
	        'city' => [
		        'class' => CityFixture::className(),
		        'dataFile' => codecept_data_dir() . 'city.php'
	        ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new Galleries();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new Galleries();

		$model->attributes = [
			'name' => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();

	}


	public function testTrueGalleries()
	{
		$model = new Galleries();
		$expectedAttrs = [
			'name' => 'Название тест 44',
			'title' => 'testtitle 2',
			'active' => 1,
			'code' => 'testcodeunique',
			'citiesField' => 1,
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$galleries = Galleries::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($galleries);

		$this->assertEquals($expectedAttrs['name'], $galleries->name);
		$this->tester->assertEquals($expectedAttrs['name'], $galleries->name);

		$this->assertEquals($expectedAttrs['title'], $galleries->title);
		$this->assertEquals($expectedAttrs['code'], $galleries->code);

	}

}