<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\GalleryValue;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GalleriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галереи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать галерею', ['create'], ['class' => 'btn btn-success']) ?>
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
            'title',
	        [
		        'attribute' => 'group',
		        'filter' => \backend\models\Galleries::getAllActiveGroupName()
	        ],
            'code',
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
	        [
		        'attribute' => 'imagesCount',
		        'label' => 'Слайдов',
		        'format' => 'html',
		        'value' => function ($model) {
			        return GalleryValue::find()->where(['galleries_id' => $model->id])->count();
		        },
	        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
