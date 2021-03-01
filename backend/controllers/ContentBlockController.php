<?php

namespace backend\controllers;

use backend\models\City;
use backend\models\ContentBlockVersions;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\ContentBlock;
use yii\web\NotFoundHttpException;
use backend\models\ContentBlockSearch;

/**
 * ContentBlockController implements the CRUD actions for ContentBlock model.
 */
class ContentBlockController extends Controller
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
				        'roles' => ['content_block_full'],// Access right
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
     * Lists all ContentBlock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentBlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single ContentBlock model.
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
    public function actionRecover($id)
    {
	    $version = ContentBlockVersions::findOne($id);
	    $content_block = ContentBlock::findOne($version->content_id);
	    $content_block->citiesField = $content_block->cities;
	    $content_block->content = $version->content;
	    $content_block->save();
	    return $this->redirect(['update', 'id' => $content_block->id]);
    }

    /**
     * Creates a new ContentBlock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentBlock();

	    if ($model->load(Yii::$app->request->post())) {

		    $post_data = Yii::$app->request->post()['ContentBlock'];

		    $postDataCities = [];

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

	    return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing ContentBlock model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
	public function actionUpdate($id)
	{

		$model = $this->findModel($id);

		$model->citiesField = $model->cities;

		/** @var ContentBlock $model */
		$model->content = Html::decode($model->content);
		$versions = ContentBlockVersions::find()->where(['content_id' => $id])->all();
		if ($model->load(Yii::$app->request->post())) {
			$model->updated_at = time();

			$post_data = Yii::$app->request->post()['ContentBlock'];

			$postDataCities = [];

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
				}
			}

			$submitForm = ArrayHelper::getValue(Yii::$app->request->post(), 'submit_form');

			if ($submitForm == 'Apply') {
				return $this->redirect(['update', 'id' => $model->id]);
			} elseif ($submitForm == 'SaveVersion') {
				$version = new ContentBlockVersions();
				$version->created_at = time();
				$version->content_id = $model->id;
				$version->content = $model->content;
				$version->save();
				return $this->refresh();
			} else {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		} else {
			return $this->render('update', [
				'model' => $model,
				'versions' => $versions,
			]);
		}
	}

    /**
     * Deletes an existing ContentBlock model.
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
     * Finds the ContentBlock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentBlock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentBlock::findOne($id)) !== null) {
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
