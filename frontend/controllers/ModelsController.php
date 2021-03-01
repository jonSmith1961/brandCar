<?php

namespace frontend\controllers;


use backend\models\Complectations;
use backend\models\Models;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModelsController extends Controller
{

	public function actionIndex()
	{
		//исправить после уточнения
		return $this->redirect(['/'], 301);
//		$this->view->params['breadcrumbs'][] = 'Модели';
//		$this->view->title = 'Модели';
//		return $this->render('index', ['models' => $models]);
	}

	/**
	 * @param string $code
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionDetail($code)
	{
		/** @var Models $model */
		$model = Models::find()
			->active()
			->with('gallery1Value')
			->with('gallery2Value')
			->andWhere(['code' => $code])
			->one();

		if ($model) {

			//Выберите массу

			$complectationsWeight = Complectations::find()
				->active()
				->distinct()
				->andWhere(['model_id' => $model->id])
				->select('weight')
				->all();

			$complectationsWeights = ArrayHelper::map($complectationsWeight, 'weight', 'weight');

			$allComplectation = ["all" => 'Все модели'];

			$complectationsWeightsArray = ($allComplectation + $complectationsWeights);

			$complectationsModel = Complectations::find()
				->active()
				->andWhere(['model_id' => $model->id])
				->orderBy(['weight' => SORT_ASC, 'sort' => SORT_ASC])
				->all();

			// отключаем в хлебных крошках страницу с моделями
//			$this->view->params['breadcrumbs'][] = [
//				'label' => 'Модели',
//				'url' => ['index']
//			];
			$this->view->params['breadcrumbs'][] = $model->title;
			$this->view->title = 'Модели';
			return $this->render('detail', compact(
					'model',
					'complectationsWeightsArray',
					'complectationsModel'
				)
			);
		}
//		throw $model NotFoundHttpException('');
	}
}
