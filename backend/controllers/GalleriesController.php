<?php

namespace backend\controllers;

use backend\models\City;
use backend\models\Files;
use common\helpers\File;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\MultipleModel;
use yii\web\Controller;
use backend\models\Galleries;
use backend\models\GalleryValue;
use backend\models\GalleriesSearch;

/**
 * GalleriesController implements the CRUD actions for Galleries model.
 */
class GalleriesController extends Controller
{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['login', 'error'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['index', 'logout', 'error'],
						'allow' => true,
						'roles' => ['@'],
					],
					[
						'actions' => ['index', 'view'],
						'allow' => true,
						'roles' => ['admin'],
					],
					[
						'allow' => true,
						'roles' => ['superadmin', 'admin']
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'logout' => ['post', 'get']
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
		];
	}

	/**
	 * Lists all Galleries models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new GalleriesSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', compact('searchModel', 'dataProvider'));
	}

	/**
	 * Displays a single Galleries model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$galleryValues = $model->galleryValues;

		return $this->render('view', [
			'model' => $model,
			'galleryValues' => $galleryValues,
		]);
	}

	/**
	 * Creates a new Galleries model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$modelGalleries = new Galleries;
		$modelsGalleryValue = [new GalleryValue];
		if ($modelGalleries->load(Yii::$app->request->post())) {

			$modelsGalleryValue = MultipleModel::createMultiple(GalleryValue::classname());
			MultipleModel::loadMultiple($modelsGalleryValue, Yii::$app->request->post());
			foreach ($modelsGalleryValue as $index => $modelGalleryValue) {
				$modelGalleryValue->sort_order = $index;
				//$modelGalleryValue->img = \yii\web\UploadedFile::getInstance($modelGalleryValue, "[{$index}]img");
				/**/
				$modelGalleryValueImg = \yii\web\UploadedFile::getInstance($modelGalleryValue, "[{$index}]img");
				if(!empty($modelGalleryValueImg)){
					if(File::isImageFile($modelGalleryValueImg)) {
						$file = new Files();
						$modelsGalleryValue[$index]->file_id = ($modelGalleryValueImg ? $file->loadFile($modelGalleryValueImg) : '');
					}
				}
			}

			$post_data = Yii::$app->request->post()['Galleries'];

			if (!empty($post_data['citiesField']) && is_array($post_data['citiesField'])) {
				$postDataCities = array_filter($post_data['citiesField']);
			}


			// ajax validation
			if (Yii::$app->request->isAjax) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ArrayHelper::merge(
					ActiveForm::validateMultiple($modelsGalleryValue),
					ActiveForm::validate($modelGalleries)
				);
			}

			// validate all models
			$validM1 = $modelGalleries->validate();
			$validM2 = MultipleModel::validateMultiple($modelsGalleryValue);
			$valid = MultipleModel::validateMultiple($modelsGalleryValue) && $validM1;

			if ($valid) {
				$transaction = \Yii::$app->db->beginTransaction();
				try {
					if ($flag = $modelGalleries->save(false)) {
						if (isset($postDataCities)) {
							$this->linkCities($modelGalleries, $postDataCities);
						} else {
							$modelGalleries->unlinkAll('cities', true);
						}
						foreach ($modelsGalleryValue as $modelGalleryValue) {
							$modelGalleryValue->galleries_id = $modelGalleries->id;

							if (($flag = $modelGalleryValue->save(false)) === false) {
								$transaction->rollBack();
								break;
							}
						}
					}
					if ($flag) {
						$transaction->commit();
						return $this->redirect(['view', 'id' => $modelGalleries->id]);
					}
				} catch (Exception $e) {
					$transaction->rollBack();
				}
			}
		}

		return $this->render('create', [
			'modelGalleries' => $modelGalleries,
			'modelsGalleryValue' => (empty($modelsGalleryValue)) ? [new GalleryValue] : $modelsGalleryValue
		]);
	}

	/**
	 * Updates an existing Galleries model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$modelGalleries = $this->findModel($id);
		$modelGalleries->citiesField = $modelGalleries->cities;
		$modelsGalleryValue = $modelGalleries->galleryValues;

		if ($modelGalleries->load(Yii::$app->request->post())) {

			$oldIDs = ArrayHelper::map($modelsGalleryValue, 'id', 'id');
			$modelsGalleryValue = MultipleModel::createMultiple(GalleryValue::classname(), $modelsGalleryValue);
			MultipleModel::loadMultiple($modelsGalleryValue, Yii::$app->request->post());
			$deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsGalleryValue, 'id', 'id')));

			$post_data = Yii::$app->request->post()['Galleries'];

			if (!empty($post_data['citiesField']) && is_array($post_data['citiesField'])) {
				$postDataCities = array_filter($post_data['citiesField']);
			}

			$modelGalleryValueImg = null;

			$modelsGalleryValueTmp = $modelsGalleryValue;
			foreach ($modelsGalleryValueTmp as $index => $modelGalleryValue) {
				$modelGalleryValue->sort_order = $index;
				$modelGalleryValueImg = \yii\web\UploadedFile::getInstance($modelGalleryValue, "[{$index}]img");
				if(!empty($modelGalleryValueImg)){
					if(File::isImageFile($modelGalleryValueImg)){
						$file = new Files();
						$modelsGalleryValue[$index]->file_id = ($modelGalleryValueImg ? $file->loadFile($modelGalleryValueImg) : '');
					}
				}
			}

			// ajax validation
			if (Yii::$app->request->isAjax) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ArrayHelper::merge(
					ActiveForm::validateMultiple($modelsGalleryValue),
					ActiveForm::validate($modelGalleries)
				);
			}

			// validate all models
			$valid = $modelGalleries->validate();
			$valid = MultipleModel::validateMultiple($modelsGalleryValue) && $valid;



			if ($valid) {
				$transaction = \Yii::$app->db->beginTransaction();
				try {
					if ($flag = $modelGalleries->save(false)) {

						if (isset($postDataCities)) {
							$this->linkCities($modelGalleries, $postDataCities);
						} else {
							$modelGalleries->unlinkAll('cities', true);
						}

						if (!empty($deletedIDs)) {
							$flag = GalleryValue::deleteByIDs($deletedIDs);
						}

						if ($flag) {
							foreach ($modelsGalleryValue as $modelGalleryValue) {
								$modelGalleryValue->galleries_id = $modelGalleries->id;
								if (($flag = $modelGalleryValue->save(false)) === false) {
									$transaction->rollBack();
									break;
								}
							}
						}
					}

					if ($flag) {
						$transaction->commit();
						return $this->redirect(['view', 'id' => $modelGalleries->id]);
					}

				} catch (\Exception $e) {
					$transaction->rollBack();
				}
			}
		}

		return $this->render('update', [
			'modelGalleries' => $modelGalleries,
			'modelsGalleryValue' => (empty($modelsGalleryValue)) ? [new GalleryValue] : $modelsGalleryValue
		]);
	}

	/**
	 * Deletes an existing Galleries model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$optonValuesIDs = ArrayHelper::map($model->galleryValues, 'id', 'id');
		GalleryValue::deleteByIDs($optonValuesIDs);
		$name = $model->name;

		if ($model->delete()) {
			Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Galleries model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Galleries the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Galleries::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}


	public function linkCities($model, $postDataCities){
		$model->unlinkAll('cities', true);
		if(count($postDataCities) > 0) {
			foreach ($postDataCities ?? [] as $rowId) {
				if (!isset($model->cities[$rowId])) {
					$model->link('cities', City::findOne($rowId));
				}
			}
		}
	}
}