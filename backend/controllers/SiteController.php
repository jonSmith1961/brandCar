<?php
namespace backend\controllers;

use backend\models\ContentBlockVersions;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
	            'rules' => [
	                [
		                'actions' => ['login', 'error'],
		                'allow' => true,
		                'roles' => ['?'],
	                ],
	                [
		                'actions' => ['index', 'logout', 'error','content-block-version'],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
	    if (!Yii::$app->user->can('dashboard')) {
		    return $this->redirect('/');
	    }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', compact('model'));
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

	public function actionContentBlockVersion($id)
	{
		$version = ContentBlockVersions::findOne($id);
		return $this->renderAjax('content-block-version', [
			'version' => $version,
		]);
	}
}
