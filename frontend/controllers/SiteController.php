<?php

namespace frontend\controllers;

use backend\models\City;
use backend\models\Galleries;
use backend\models\GalleryValue;
use backend\models\Models;
use backend\models\News;
use backend\models\Specials;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'only' => ['login', 'logout'],
				'rules' => [
					[
						'actions' => ['login'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'logout' => ['post', 'get'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function beforeAction($action)
	{
		// Если проблема с токеном, обновляем.
		if (!$this->request->validateCsrfToken()) {
			return $this->goHome();
		}
		return parent::beforeAction($action);
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{

		$mainPageTopGallery = Galleries::find()
			->activeAndCurrentCity()
			->andWhere(
				[Galleries::tableName().'.code' => 'main-page-top']
			)
			->one();

		$mainPageTopGalleryId = ArrayHelper::getValue($mainPageTopGallery, 'id');

		$mainPageTopGalleryValues = null;

		if(!empty($mainPageTopGalleryId)) {
			$mainPageTopGalleryValues = GalleryValue::find()->where(['galleries_id' => $mainPageTopGalleryId])->all();
		}

		$mainPageSpecials = Specials::find()->activeAndCurrentCity()->all();

		$mainPageNews = News::find()
			->activeAndCurrentCity()
			->orderBy([
				News::tableName().'.active_from' => SORT_DESC,
			])
			->limit(3)
			->all();

		$models = Models::find()->active()->orderBy(['sort' => SORT_ASC])->all();

		return $this->render(
			'index',
			compact(
				'mainPageTopGalleryValues',
				'mainPageSpecials',
				'mainPageNews',
				'models'
			)
		);
	}


	/**
	 * О компании
	 *
	 * @return mixed
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}
	/**
	 * Юр. информация.
	 *
	 * @return mixed
	 */
	public function actionPrivacy()
	{
		return $this->render('privacy');
	}
}
