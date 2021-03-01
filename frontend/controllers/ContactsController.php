<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 27.03.2018
 * Time: 10:48
 */

namespace frontend\controllers;


use backend\models\City;
use backend\models\DealerCenter;
use backend\models\ThemeMessage;
use common\helpers\CityHelper;
use frontend\models\FeedbackForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ContactsController extends Controller
{
	public function actionIndex()
	{

		$city = City::getCurrentCity();
		$dealerCenters  = DealerCenter::find()->currentCity()->all();


		$itemsMapPoints = [];
		$mapCenterPoint = [];

		foreach ($dealerCenters as $key =>  $dealerCenter) {

			if(!empty($dealerCenter->latitude) && !empty($dealerCenter->longitude) ) {

				$cityName = $city->name ?? '';
				$cityPhone = $city->phone ?? '';
				$dealerCenterPhone = $dealerCenter->phone ?? '';
				$dealerCenterAddress = $dealerCenter->address ?? '';
				$dealerCenterEmail = $dealerCenter->email ?? '';

				$dealerCenterCoordinatesLatitude = $dealerCenter->latitude ?? '';
				$dealerCenterCoordinatesLongitude = $dealerCenter->longitude ?? '';

				if($key === 0){
					$mapCenterPoint = [
						$dealerCenterCoordinatesLatitude,
						$dealerCenterCoordinatesLongitude
					];
				}


				$dealerCenterPhoneGetDigitOnly = CityHelper::filterPhoneGetDigitOnly($dealerCenter->phone) ?? '';
				$cityPhoneSupport = CityHelper::filterPhoneGetDigitOnly($city->phone_support) ?? '';
				$cityPhoneSupportGetDigitOnly = CityHelper::filterPhoneGetDigitOnly($city->phone_support) ?? '';

				$contentMapCenter = "
	<p>$cityName $dealerCenterAddress</p>
						<p><a href='tel:+" . $dealerCenterPhoneGetDigitOnly . "'>$dealerCenterPhone</a></p>
	<p><a href='tel:" . $cityPhoneSupportGetDigitOnly . "'> $cityPhoneSupport</a></p>
	
	
		<a href='mailto:" . $dealerCenterEmail . "'>$dealerCenterEmail</a>
";

				$itemsMapPoints[] =
					[
						'latitude' => $dealerCenterCoordinatesLatitude,
						'longitude' => $dealerCenterCoordinatesLongitude,
						'options' => [
							[
								'hintContent' => $dealerCenterAddress,
								'balloonContentHeader' => 'АГАТ Официальный дистрибьютор автомобилей марки ISUZU',
								'balloonContentBody' => $contentMapCenter,
								//'balloonContentFooter' => 'Футер после нажатия на маркер',
								'balloonContent' => "<div style='padding: 13px 35px 0 10px;'>" . $dealerCenterAddress . "</div>",
							],
							[
								'preset' => 'islands#icon',
								'iconColor' => '#19a111',
								'iconLayout' => 'default#image',
								'iconImageHref' => '/images/ico-point-map.png',
								'iconImageSize' => [30, 42],
								'iconImageOffset' => [-15, -42]
							]
						]
					];

			}
		}

		return $this->render('index', compact('city','dealerCenters','itemsMapPoints','mapCenterPoint'));
	}

	public function actionFeedback()
	{


		$model = new FeedbackForm();

		$cityFormValue = ArrayHelper::getValue(City::getCurrentCity(), 'id');
		$subjectFormValue = ArrayHelper::getValue(ThemeMessage::find()->select('id')->where(['code' => 'sale'])->one(), 'id');


		/* получаем данные из формы и запускаем функцию отправки contact, если все хорошо, выводим сообщение об удачной отправке сообщения на почту */
		if (
			$model->load(Yii::$app->request->post())
			&&
			$model->sending()) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			return $this->refresh();
			/* иначе выводим форму обратной связи */
		} else {
			return $this->render('feedback', compact(
				'model',
				'cityFormValue',
				'subjectFormValue'
			));
		}



	}
}