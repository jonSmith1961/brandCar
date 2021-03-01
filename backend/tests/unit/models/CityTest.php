<?php

namespace backend\tests\unit\models;

use Codeception\Test\Unit;
use common\tests\UnitTester;
use Yii;
use backend\models\City;
use backend\tests\fixtures\CityFixture;

/**
 * Login form test
 */
class CityTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;
	protected $className;

	protected function _before()
	{

		$this->className = City::className();

	}


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
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
			'name' => 'Город'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();

	}
	public function testWrongName()
	{
		$model = new $this->className;

		$model->attributes = [
			'name' => 'one title'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('name');

	}

	public function testShortName()
	{
		$model = new $this->className;

		$model->attributes = [
			'name' => 'H'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('name');

	}

	public function testFieldActiveNotInteger()
	{
		$model = new $this->className;

		$model->attributes = [
			'active' => 'string'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key active must have in array errors', $model->errors)->hasKey('active');

	}

	public function testLongPhoneSupport()
	{
		$model = new $this->className;

		$model->attributes = [
			'phone_support' => '123456789012345678901'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key phone_support must have in array errors', $model->errors)->hasKey('phone_support');

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
		$obj = new City();
		return $obj->getAllFieldsGroupByType()->getFieldsByType('integer');
	}


	public function testLongPhone()
	{
		$model = new $this->className;

		$model->attributes = [
			'phone' => '123456789012345678901'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key phone must have in array errors', $model->errors)->hasKey('phone');

	}

	public function testLongName()
	{
		$model = new $this->className;

		$model->attributes = [
			'name' => 'цщукзшгецзщушкгезщцушкгезщцшугкещзшугкцезщшгцзукешгцушгкеншщцугкенщшгншщгцункещшцгукеншщгцкежрлордорфжваопрфваопрылжвоапрыдлвоапрывалопрылдвоапрылваопрлыдпаловаарыплдоршдкгеншгукрпвшгкеершупоыаршгнкешыгарлыовврппршгыукрлпоыршгыукршшывгралопршыгкршорпчлоавр'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key name must have in array errors', $model->errors)->hasKey('name');

	}

	public function testLongCode()
	{
		$model = new $this->className;

		$model->attributes = [
			'code' => 'qwertwpieurtypiweurtyiweurtyioweurytioweurytioweurtyioaslkjdfhklajfhlkjahfklgjahdkfjghkadjfgkajdfgkajddfhgkajddfhkgkjaddhfkgkjadhfkgkjahdkfjghklazcvbvbzkcvjhblzkcvjhblkzjcvhblkzuvycoiuzyoiuyzouvybozhvblzvzuvbhoizuvcybiozucvhbzjcvhobzciuvhkjewrhtklwjehrtklj'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');

	}

//[['name', 'code', 'phone', 'email'], 'string', 'min' => 2, 'max' => 255],
	public function testShortPhoneSupport()
	{
		$model = new $this->className;

		$model->attributes = [
			'phone_support' => '1'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key phone_support must have in array errors', $model->errors)->hasKey('phone_support');

	}

	public function testShortPhone()
	{
		$model = new $this->className;

		$model->attributes = [
			'phone' => '1'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key phone must have in array errors', $model->errors)->hasKey('phone');

	}

	public function testNotUniqueName()
	{
		$model = new $this->className;

		$nameCityTest = 'Город тест';

		$model->attributes = [
			'name' => $nameCityTest,
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect($model->getFirstError('name'));
		expect('key name must have in array errors', $model->errors)->hasKey('name');

	}

	public function testNotUniqueCode()
	{
		$model = new $this->className;

		$codeTest = 'city-test';

//		$message = 'Значение «'.$codeTest.'» для «Символьный код» уже занято.';

		$model->attributes = [
			'code' => $codeTest,
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
		expect('key code must have in array errors', $model->errors)->hasKey('code');
	}

	public function testWrongCode()
	{
		$model = new $this->className;

		$codeTest = 'фываы';

//		$message = 'Значение «'.$codeTest.'» для «Символьный код» уже занято.';

		$model->attributes = [
			'code' => $codeTest,
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
//		$test = $model->getFirstError('code');
//		expect($model->getFirstError('code'))->equals($message);
		expect('key code must have in array errors', $model->errors)->hasKey('code');

	}

    public function testCityWrongMail()
    {
		$model = new $this->className;
		$model->attributes = [
			'email' => 'WrongMail'
		];

		$validate = $model->validate();

		expect('Validation should be failed', $validate)->false();
		expect($model->hasErrors())->true();
//		expect($model->getFirstError('email'))->equals('Значение «E-mail» не является правильным email адресом.');
	    expect('key email must have in array errors', $model->errors)->hasKey('email');
	}

    public function testTrueCity()
    {
		$model = new $this->className;
	    $expectedAttrs = [
		    'name' => 'Город Тест Тест',
		    'code' => 'testcode',
		    'phone' => '+7 (332) 4-375-847',
		    'email' => 'nicuole.pacek@schultz.info',
		    'phone_support' => '8 800 770 70 22',
		    'active' => '1',
		    'created_at' => '1402312317',
		    'updated_at' => '1402312317',
	    ];

		$model->attributes = $expectedAttrs;

		expect('Validation should be success', $model->validate())->true();
		expect($model->hasErrors())->false();

	    $this->assertTrue($model->save());

	    $expectedAttrs['id'] = $model->id;

	    $city = City::find()->where(['id' =>$expectedAttrs['id']])->one();
	    $this->assertNotNull($city);

	    $this->assertEquals($expectedAttrs['name'], $city->name);
	    $this->tester->assertEquals($expectedAttrs['name'], $city->name);

		$this->assertEquals($expectedAttrs['email'], $city->email);
		$this->assertEquals($expectedAttrs['code'], $city->code);

	}

	public function testDeleteCity()
	{
		// delete
		$record = new $this->className;
		$record->name = 'Город Тест Тест Первый Тест';
		$record->code = 'testcode';
		$record->phone = '+7 (332) 4-375-847';
		$record->email = 'nicuole.pacek@schultz.info';
		$record->phone_support = '8 800 770 70 22';
		$record->active = 1;
		$record->created_at = 1402312317;
		$record->updated_at = 1402312317;

		$record->save();

		$recordId = $record->id;

		$record = City::findOne($recordId);
		$record->delete();
		$record = City::findOne($recordId);
		$this->assertNull($record);

		// deleteAll
		$record = new $this->className;
		$record->name = 'Город Тест Тест Второй Тест';
		$record->code = 'testcode';
		$record->phone = '+7 (332) 4-375-847';
		$record->email = 'nicuole.pacek@schultz.info';
		$record->phone_support = '8 800 770 70 22';
		$record->active = 1;
		$record->created_at = 1402312317;
		$record->updated_at = 1402312317;
		$record->save();

		$ret = City::deleteAll(['name' => 'Город Тест Тест Второй Тест']);
		$this->assertEquals(1, $ret);
		$records = City::find()->where(['name' => 'Город Тест Тест Второй Тест'])->all();
		$this->assertEquals(0, count($records));
	}
}
