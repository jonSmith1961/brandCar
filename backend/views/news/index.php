<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\File;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

/**
var $dates = $('#from, #to').datepicker();

$('#clear-dates').on('click', function () {
$dates.datepicker('setDate', null);
});
 *
 */

$JS = "
	console.log('dataPickerClearField');
	
	$('#clear-dates').on('click', function () {
		$('#newssearch-active_from').datepicker('setDate', null);
	});
";
$this->registerJS($JS);
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::tag('span','Очистить дату в фильтре', ['class' => 'btn btn-info', 'id' => 'clear-dates']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'alias',
            'title',
//            'brief:ntext',
//            'text:ntext',
            //'sub_title:ntext',
            //'active_from',
//	        [
//		        'attribute' => 'active_from',
//		        'value' => function ($data) {
//			        return '<span class="nowrap">' . Yii::$app->formatter->asDatetime($data['active_from'], 'dd.MM.yyyy') . '</span>';
//		        },
//		        'format' => 'html',
//	        ],
	        [
		        'attribute' => 'active_from',
		        'format' => 'html',
		        'value' => function ($model) {
			        return $model->active_from ? Yii::$app->formatter->asDate($model->active_from, 'dd.MM.yyyy') : '';
		        },
		        'filter' => \dosamigos\datepicker\DatePicker::widget([
			        'model' => $searchModel,
			        'value' => $searchModel->active_from,
			        'attribute' => 'active_from',
			        'language' => 'ru',
			        'clientOptions' => [
				        'autoclose' => true,
				        'format' => 'dd.mm.yyyy'
			        ]
		        ]),
	        ],
            //'active',
	        [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            'sort',
            //'preview_picture',

	        [
		        'attribute' => 'preview_picture',
		        'label' => 'Превью',
		        'content' => function ($model) {
			        return File::GetResizedImage($model['preview_picture'], 100, 0);
		        }
	        ],
//	        [
//		        'attribute' => 'detail_picture',
//		        'label' => 'Превью',
//		        'content' => function ($model) {
//			        return File::GetResizedImage($model['detail_picture'], 100, 0);
//		        }
//	        ],
            //'detail_picture',
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
