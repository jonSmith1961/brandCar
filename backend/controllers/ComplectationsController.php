<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\helpers\ModelsHelper;
use backend\models\Complectations;
use yii\web\NotFoundHttpException;
use backend\models\ComplectationsSearch;

/**
 * ComplectationsController implements the CRUD actions for Complectations model.
 */
class ComplectationsController extends Controller
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
				        'roles' => ['complectations_full'],// Access right
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
     * Lists all Complectations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComplectationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Complectations model.
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
     * Creates a new Complectations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Complectations();


	    if ($model->load(Yii::$app->request->post())) {

		    $model = ModelsHelper::loadAndSaveFilesImageAndDocFromPost($model);

		    $validate = $model->validate();
		    if($validate) {
			    if ($model->save()) {
				    return $this->redirect(['view', 'id' => $model->id]);
			    }
		    }
	    }
	    return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Complectations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	    $model = ModelsHelper::holdOldValuesInArray($model);

	    if ($model->load(Yii::$app->request->post())) {

		    $model = ModelsHelper::loadAndSaveFilesImageAndDocFromPost($model);

		    $validate = $model->validate();
		    if($validate) {
			    if ($model->save()) {
				    return $this->redirect(['view', 'id' => $model->id]);
			    }
		    }
	    }

	    return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Complectations model.
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
     * Finds the Complectations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Complectations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Complectations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
