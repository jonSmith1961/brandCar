<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SpecialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать акцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
	        'title',
	        'alias',
            'brief:ntext',
//            'text:ntext',

	        [
		        'attribute' => 'preview_picture',
		        'label' => 'Превью',
		        'content' => function ($model) {
			        return \common\helpers\File::GetResizedImage($model['preview_picture'], 100, 0);
		        }
	        ],
//	        [
//		        'attribute' => 'detail_picture',
//		        'label' => 'Детальная картинка',
//		        'content' => function ($model) {
//			        return \common\helpers\File::GetResizedImage($model['detail_picture'], 100, 0);
//		        }
//	        ],
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
            //'sub_title:ntext',
            //'active',
	        [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            'url:url',
            'sort',
            //'preview_picture',
            //'detail_picture',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
