<?php

namespace frontend\controllers;

use backend\models\News;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{

	public function actionIndex()
	{
		$this->view->params['breadcrumbs'][] = 'Новости';
		$this->view->title = 'Новости';


		/** @var News $specials */
		$query = News::find()
			->activeAndCurrentCity()
			->orderBy([
				News::tableName().'.sort' => SORT_ASC,
				News::tableName().'.active_from' => SORT_DESC,
			]);

		$countQuery = clone $query;

		$pages = new Pagination([
			'totalCount' => $countQuery->count(),
			'pageSize' => 3
		]);

		$pages->pageSizeParam = false;
		$newsAll = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();

		return $this->render('index', compact('newsAll', 'pages'));
	}

	/**
	 * @param string $alias
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionDetail($alias)
	{
		/** @var News $new */
		$news = News::find()
			->activeAndCurrentCity()
			->andWhere(['alias' => $alias])
			->with('gallery1')
			->one();
		if ($news) {
			$this->view->params['breadcrumbs'][] = [
				'label' => 'Новости',
				'url' => ['index']
			];
			$this->view->params['breadcrumbs'][] = $news->title;
			$this->view->title = 'Новости';
			return $this->render('detail', compact('news'));
		}
		throw new NotFoundHttpException('');
	}
}
