<?php namespace backend\tests\models;

use backend\models\News;
use backend\tests\fixtures\CityFixture;
use backend\tests\fixtures\FilesFixture;
use backend\tests\fixtures\NewsFixture;

class NewsTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */

    protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = News::className();

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
            'news' => [
                'class' => NewsFixture::className(),
                'dataFile' => codecept_data_dir() . 'news.php'
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
		$obj = new News();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}

	public function testTrueNews()
	{
		$model = new $this->className;
		$expectedAttrs = [
			'active' => 1,
			'alias' => 'testcodeu', //	character varying(255)
			'title' => 'Заголовок тест 2', //	character varying(255)
			'brief' => 'Описание тест', //	text
			'text' => ' Текст ', //	text
			'sub_title' => 'Подзаголовок', //	text
			'active_from' => 1392559490, //	integer
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

		$news = News::find()->where(['id' =>$expectedAttrs['id']])->one();
		$this->assertNotNull($news);

		$this->assertEquals($expectedAttrs['title'], $news->title);
		$this->tester->assertEquals($expectedAttrs['title'], $news->title);

		$this->assertEquals($expectedAttrs['brief'], $news->brief);
		$this->assertEquals($expectedAttrs['alias'], $news->alias);

	}
}