<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DealerCenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дилерские центры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealer-center-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
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
	        [
				'attribute' => 'cityName',
				'label' => 'Город',
				'value'=>'city.name',
		        'filter' => \backend\models\City::getAllActiveIdName()
			],
            'phone',
            'email:email',
            //'address',
            //'post_code',
            //'latitude',
            //'longitude',
            //'map_link',
            [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            //'start_time',
            //'end_time',
            //'start_time_saturday',
            //'end_time_saturday',
            //'start_time_sunday',
            //'end_time_sunday',
            //'start_time_holidays',
            //'end_time_holidays',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
