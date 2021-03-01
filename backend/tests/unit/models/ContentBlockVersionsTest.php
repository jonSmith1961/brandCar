<?php namespace backend\tests\models;

use backend\models\ContentBlockVersions;
use backend\tests\fixtures\ContentBlockVersionsFixture;

class ContentBlockVersionsTest extends \Codeception\Test\Unit
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
            'content-block-versions' => [
                'class' => ContentBlockVersionsFixture::className(),
                'dataFile' => codecept_data_dir() . 'content-block-versions.php'
            ]
        ];
    }

	public function testEmptyValues()
	{
		$model = new ContentBlockVersions();

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
	}

    


}