<?php namespace backend\tests\models;

use backend\models\GalleryValue;
use backend\tests\fixtures\FilesFixture;
use backend\tests\fixtures\GalleriesFixture;
use backend\tests\fixtures\GalleryValueFixture;

class GalleryValueTest extends \Codeception\Test\Unit
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
            'gallery-value' => [
                'class' => GalleryValueFixture::className(),
                'dataFile' => codecept_data_dir() . 'gallery-value.php'
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
		$model = new GalleryValue();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

	public function testNameOnly()
	{
		$model = new GalleryValue();

		$model->attributes = [
			'name' => 'Название'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();

	}


	public function testTrueGalleryValue()
	{
		$model = new GalleryValue();
		$expectedAttrs = [
			'galleries_id' => 1,
			'name' => 'sdafsxdv',
			'url' => 'sdafssd',
			'text' => 'text test test',
			'property' => 'property property text test',
			'sort_order' => 1,
			'file_id' => 1,
		];

		$model->attributes = $expectedAttrs;

		$validate = $model->validate();

		expect('Validation should be success', $validate)->true();
		expect($model->hasErrors())->false();

		$this->assertTrue($model->save());

		$expectedAttrs['id'] = $model->id;

		$galleryvalue = GalleryValue::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($galleryvalue);

		$this->assertEquals($expectedAttrs['name'], $galleryvalue->name);
		$this->tester->assertEquals($expectedAttrs['name'], $galleryvalue->name);

		$this->assertEquals($expectedAttrs['url'], $galleryvalue->url);
		$this->assertEquals($expectedAttrs['property'], $galleryvalue->property);

	}

}