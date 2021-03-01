<?php

namespace backend\controllers;

use Yii;
use backend\models\DealerCenter;
use backend\models\DealerCenterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * DealerCenterController implements the CRUD actions for DealerCenter model.
 */
class DealerCenterController extends Controller
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
				        'roles' => ['dealer_center_full'],// Access right
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
     * Lists all DealerCenter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DealerCenterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

	/**
	 * Displays a single DealerCenter model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DealerCenter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DealerCenter();

        if ($model->load(Yii::$app->request->post())) {
        	if($model->validate()){
        		if($model->save()){
			        return $this->redirect(['view', 'id' => $model->id]);
		        }
	        }

        }

        return $this->render('create', compact('model'));
    }

	/**
	 * Updates an existing DealerCenter model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

	/**
	 * Deletes an existing DealerCenter model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	/**
	 * Finds the DealerCenter model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return DealerCenter the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    protected function findModel(int $id)
    {
        if (($model = DealerCenter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
