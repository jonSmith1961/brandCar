<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContentBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контент блоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-block-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать контент блок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'active',

            'code',
            'content:ntext',
	        [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
	        [
		        'attribute' => 'citiesField',
		        'format' => 'html',
		        'value' => function ($model) {
			        $cities = '';
			        foreach ($model->cities as $key => $city) {
				        if ($key !== 0) {
					        $cities .= '<br />';
				        }
				        $cities .= $city['name'];
			        }
			        return $cities;
		        },
		        'filter' => \backend\models\City::getAllActiveIdName()
	        ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
