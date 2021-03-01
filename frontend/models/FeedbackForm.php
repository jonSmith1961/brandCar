<?php
namespace frontend\models;


use backend\models\City;
use backend\models\ThemeMessage;
use common\helpers\CityHelper;
use common\helpers\CommonHelper;
use common\helpers\MailHelper;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class FeedbackForm extends Model
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index'],
						'allow' => true,
					],
				]
			]
		];
	}

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			]
		];
	}


	/* Объявление переменных для полей формы */
	public $title, $name, $formName, $city, $phone, $email, $subject, $agreement, $comment, $verifyCode;

	/* Правила для полей формы обратной связи (валидация) */
	public function rules()
	{
		return [
			[['name', 'phone', 'email', 'subject', 'comment' ], 'filter', 'filter' => 'trim'],
			[['name', 'city', 'phone', 'email', 'subject', 'comment' ],'required'],
			[['city', 'subject' ],'integer'],
			[['name', 'formName', 'phone', 'email'], 'string', 'min' => 2, 'max' => 255],
			[['name'], 'match', 'pattern' => '/^[а-яё\s-]+$/iu', 'message' => 'Используйте русские буквы.'],
			['city', 'in', 'range' => City::getAllActiveIds()],
			['subject', 'in', 'range' => ThemeMessage::getAllActiveIds()],
			[['phone'], 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{1}\-[0-9]{3}\-[0-9]{3}$/', 'message' => ' Введите корректный номер телефона' ],
			[['agreement'], 'required', 'requiredValue' =>  'Да', 'message'=>'Для отправки необходимо согласие на обработку персональных данных'],
			['email', 'email'],

		];
	}

	public function attributeLabels()
	{
		return [
			'name' => 'ФИО',
			'city' => 'Город',
			'phone' => 'Телефон',
			'email' => 'Электронный адрес',
			'subject' => 'Тема',
			'comment' => 'Сообщение',
			'agreement' => 'Согласие на обработку персональных данных',
		];
	}

	/* функция отправки письма на почту */
	public function sending()
	{
		/* Проверяем форму на валидацию */
		if ($this->validate()) {

			$recipientsCenter = CityHelper::getRecipientsCenterByThemeCurrentCity($this->subject);

			$recipients = CityHelper::getRecipientsByThemeCurrentCity($this->subject);
			$recipients = trim($recipients);
			$recipients = trim($recipients,',');
			$recipients = trim($recipients);
			$glue = '';
			if(!empty($recipients)){
				$glue = ',';
			}
			$recipients = $recipients.$glue.'al.filippov@domen.com';
			$recipients = explode(',', $recipients);


			$brand = 'Isuzu';


			$themeMessage = ThemeMessage::find()->where(['id' => $this->subject])->one();

			$nameThemeMessage = ArrayHelper::getValue($themeMessage, 'name');
			$themeCrmThemeMessage = ArrayHelper::getValue($themeMessage, 'theme_crm');

			//сделать отправку уведомления клиенту
//			Yii::$app->mailer->compose()
//				->setFrom([$this->email => $this->name]) /* от кого */
//				->setTo($recipients) /* куда */
//				->setSubject($nameThemeMessage) /* тема письма */
//				->setTextBody($this->comment) /* текст сообщения */
//				->send(); /* функция отправки письма */


			$arData = [
				'site' => $_SERVER['HTTP_HOST'],
				'type' => $themeCrmThemeMessage,
				'name' => $this->name,
				'phone' => $this->phone,
				'email' => $this->email,
				'center' => $recipientsCenter->name,
				'comment' => $this->comment,
				'brand' => $brand,
				'adv' => 'Согласие на обработку данных: ' . $this->agreement . ';
Страница заполнения: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
			];

			if ($recipients) {

				$formName = 'Обратная связь';

				if(!empty($this->formName)){
					$formName = $this->formName;
				}

				$mailer = Yii::$app->mailer->compose();
				$mailer->setFrom(Yii::$app->params['fromEmail'])
					->setTo($recipients)
					->setHtmlBody(MailHelper::createMailBody([
						'Имя' => $this->name,
						'Телефон' => $this->phone,
						'E-mail' => $this->email,
						'Бренд' => $brand,
						'Комментарий' => $this->comment,
					]))
					->setSubject('Заполнена форма "'.$formName.'" на сайте ' . Yii::$app->request->hostName)
					->setCharset('UTF-8')
					->send();
			}


			CommonHelper::sendToCrmTest($arData);

			return true;
		} else {
			return false;
		}
	}
}