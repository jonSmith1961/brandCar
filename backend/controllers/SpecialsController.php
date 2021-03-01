<?php

namespace backend\controllers;

use backend\models\City;
use common\helpers\ModelsHelper;
use Yii;
use backend\models\Specials;
use backend\models\SpecialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SpecialsController implements the CRUD actions for Specials model.
 */
class SpecialsController extends Controller
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
//			        [
//				        'actions' => ['index', 'view', 'update', 'create', 'delete'],
//				        'allow' => true,
//				        'roles' => ['specials_full'],
//			        ],
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
     * Lists all Specials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Specials model.
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
     * Creates a new Specials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Specials();

	    if ($model->load(Yii::$app->request->post())) {

		    $post_data = Yii::$app->request->post()['Specials'];

		    if (!empty($post_data['citiesField']) && is_array($post_data['citiesField'])) {
			    $postDataCities = array_filter($post_data['citiesField']);
		    }


		    $model = ModelsHelper::loadAndSaveFilesFromPost($model, true);

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
     * Updates an existing Specials model.
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

		    $post_data = Yii::$app->request->post()['Specials'];

		    $model = ModelsHelper::saveFilesFromPost($model, true);

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
     * Deletes an existing Specials model.
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
     * Finds the Specials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Specials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specials::findOne($id)) !== null) {
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
