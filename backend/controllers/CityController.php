<?php

namespace backend\controllers;

use Yii;
use common\helpers\CF;
use yii\web\Controller;
use backend\models\City;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\CitySearch;
use yii\web\NotFoundHttpException;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends Controller
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
				        'roles' => ['city_full'],// Access right
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
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CitySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single City model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);

	    if(!empty($model->social)){
		    $model->social = CF::stdClassDecode($model->social);
	    }
        return $this->render('view', compact('model'));
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new City();

        if ($model->load(Yii::$app->request->post())) {


	        if ($model->validate()) {
		        if(!empty($model->social)){
			        $model->social = CF::stdClassDecode($model->social);
		        }
		        if ($model->save()) {
			        return $this->redirect(['view', 'id' => $model->id]);
		        }
	        }
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post())) {
		    if ($model->validate()) {
			    if ($model->save()) {

				    return $this->redirect(['view', 'id' => $model->id]);
			    }
		    }
	    } else {
		    if(!empty($model->social)){
			    $model->social = CF::stdClassDecode($model->social);
		    }
	    }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing City model.
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
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
