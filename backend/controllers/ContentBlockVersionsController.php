<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use backend\models\ContentBlockVersions;
use backend\models\ContentBlockVersionsSearch;

/**
 * ContentBlockVersionsController implements the CRUD actions for ContentBlockVersions model.
 */
class ContentBlockVersionsController extends Controller
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
				        'roles' => ['content_block_versions_full'],// Access right
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
     * Lists all ContentBlockVersions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentBlockVersionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single ContentBlockVersions model.
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
     * Creates a new ContentBlockVersions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentBlockVersions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing ContentBlockVersions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing ContentBlockVersions model.
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
     * Finds the ContentBlockVersions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentBlockVersions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentBlockVersions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
