<?php

namespace frontend\controllers;


use backend\models\City;
use backend\models\Complectations;
use backend\models\Models;
use backend\models\ThemeMessage;
use frontend\models\FeedbackForm;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ComplectationsController extends Controller
{

	public function actionIndex()
	{
		//исправить после уточнения
		return $this->redirect(['/'], 301);
//		$models = [];
//		$this->view->params['breadcrumbs'][] = 'Модели';
//		$this->view->title = 'Модели';
//		return $this->render('index', ['models' => $models]);
	}

	/**
	 * @param string $series
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionDetail($series)
	{
		/** @var Models $model */
		$complectation = Complectations::find()
			->active()
			->with('gallery1Value')
			->with('gallery2Value')
			->andWhere(['series' => $series])
			->one();

		if ($complectation) {

			// отключаем в хлебных крошках страницу с комплектациями
//			$this->view->params['breadcrumbs'][] = [
//				'label' => 'Комплектации',
//				'url' => ['index']
//			];

			$model = $modelModalOrderForm = new FeedbackForm();

			$cityFormValue = ArrayHelper::getValue(City::getCurrentCity(), 'id');
			$subjectFormValue = ArrayHelper::getValue(ThemeMessage::find()->select('id')->where(['code' => 'sale'])->one(), 'id');

			$this->view->params['breadcrumbs'][] = $complectation->title;
			$this->view->title = 'Комплектации';

			if (
				$model->load(Yii::$app->request->post())
				&&
				$model->sending()) {
				Yii::$app->session->setFlash('contactFormSubmitted');
				return $this->refresh();
				/* иначе выводим форму обратной связи */
			} else {
				return $this->render('detail', compact(
					'complectation',
					'model',
					'subjectFormValue',
					'cityFormValue'
				));
			}
		}
//		throw $model NotFoundHttpException('');
	}
}
