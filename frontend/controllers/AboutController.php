<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 27.03.2018
 * Time: 10:48
 */

namespace frontend\controllers;


use yii\web\Controller;

class AboutController extends Controller
{
	public function actionIndex()
	{

		return $this->render('index');
	}
}