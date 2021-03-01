<?php

namespace backend\controllers;

use backend\models\City;
use common\helpers\ModelsHelper;
use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
				        'actions' => ['login'],
				        'allow' => true,
				        'roles' => ['?'],
			        ],
			        [
				        'actions' => ['logout'],
				        'allow' => true,
				        'roles' => ['@'],
			        ],
			        [
				        'actions' => ['index', 'view', 'update', 'create', 'delete'],
				        'allow' => true,
				        'roles' => ['news_full'],// Access right
			        ],
			        [
				        'actions' => ['index', 'view'],
				        'allow' => true,
				        'roles' => ['admin'],
			        ],
			        [
				        'allow' => true,
				        'roles' => ['superadmin']
			        ],
		        ],
	        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    $searchModel->active_from =  $searchModel->active_from ? Yii::$app->formatter->asDate($searchModel->active_from, 'dd.MM.yyyy') : '';

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

	    if ($model->load(Yii::$app->request->post())) {

		    $post_data = Yii::$app->request->post()['News'];

		    $model->active_from = $post_data['active_from'] ? strtotime($post_data['active_from']) : time();

		    if (!empty($post_data['citiesField']) && is_array($post_data['citiesField'])) {
			    $postDataCities = array_filter($post_data['citiesField']);
		    }

		    $model = ModelsHelper::loadAndSaveFilesFromPost($model);

		    $validate = $model->validate();
		    if($validate) {
			    if ($model->save()) {

				    if (isset($postDataCities)) {
					    $this->linkCities($model, $postDataCities);
				    } else {
					    $model->unlinkAll('cities', true);
				    }

				    return $this->redirect(['view', 'id' => $model->id]);
			    }
		    }
	    }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    $model->citiesField = $model->cities;

	    $model = ModelsHelper::holdOldValuesInArray($model);

	    if ($model->load(Yii::$app->request->post())) {

		    $post_data = Yii::$app->request->post()['News'];

		    $model->active_from = $post_data['active_from'] ? strtotime($post_data['active_from']) : time();

		    $model = ModelsHelper::saveFilesFromPost($model);

		    if (!empty($post_data['citiesField']) && is_array($post_data['citiesField'])) {
			    $postDataCities = array_filter($post_data['citiesField']);
		    }


		    $validate = $model->validate();
		    if($validate) {
			    if ($model->save()) {


				    if (isset($postDataCities)) {
					    $this->linkCities($model, $postDataCities);
				    } else {
					    $model->unlinkAll('cities', true);
				    }

				    return $this->redirect(['view', 'id' => $model->id]);
			    }
		    }
	    }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
