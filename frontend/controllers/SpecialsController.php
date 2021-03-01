<?php

namespace frontend\controllers;


use backend\models\Specials;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SpecialsController extends Controller
{

	public function actionIndex()
	{
		$this->view->params['breadcrumbs'][] = 'Акции';
		$this->view->title = 'Акции';

		/** @var Specials $specials */
		$query = Specials::find()
			->activeAndCurrentCity()
			->orderBy([
				Specials::tableName().'.sort' => SORT_ASC,
				Specials::tableName().'.id' => SORT_DESC,
			]);

		$countQuery = clone $query;

		$pages = new Pagination([
			'totalCount' => $countQuery->count(),
			'pageSize' => 3
		]);

		$pages->pageSizeParam = false;
		$specials = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();


		return $this->render('index', compact('specials', 'pages'));
	}

	/**
	 * @param string $alias
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionDetail($alias)
	{
		/** @var Specials $special */
		$special = Specials::find()
			->active()
			->andWhere(['alias' => $alias])
			->one();
		if ($special) {
			$this->view->params['breadcrumbs'][] = [
				'label' => 'Акции',
				'url' => ['index']
			];
			$this->view->params['breadcrumbs'][] = $special->title;
			$this->view->title = 'Акции';
			return $this->render('detail', compact('special'));
		}
		throw new NotFoundHttpException('');
	}
}
