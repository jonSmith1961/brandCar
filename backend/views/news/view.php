<?php

use common\helpers\File;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

		<?= Html::a('Создать новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'alias',
            'title',
//            'brief:ntext',
	        [
		        'attribute' => 'brief',
		        'format' => 'html',
	        ],
//            'text:ntext',
	        [
		        'attribute' => 'text',
		        'format' => 'html',
	        ],
            'sub_title:ntext',
//            'active_from',
	        [
		        'attribute' => 'active_from',
		        'format' => 'html',
		        'value' => function ($model) {
			        return $model->active_from ? Yii::$app->formatter->asDate($model->active_from, 'dd.MM.yyyy') : '';
		        },
	        ],
            [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            'sort',
//            'preview_picture',
//            'detail_picture',
//            'city_id',
	        [
		        'attribute' => 'preview_picture',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->preview_picture);
		        },
	        ],
	        [
		        'attribute' => 'detail_picture',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->detail_picture);
		        },
	        ],
	        [
		        'attribute' => 'gallery1_id',
		        'value'=>function ($data) {
			        return $data->gallery1 ? $data->gallery1->name : '';
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
        ],
    ]) ?>

</div>
