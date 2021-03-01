<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DealerCenter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Дилерские центры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dealer-center-view">

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
            'name',
	        [
				'attribute' => 'cityName',
				'label' => 'Город',
				'value'=>function ($data) {
					return $data->city ? $data->city->name : '';
				}
			],
            'phone',
            'email:email',
            'address',
            'post_code',
            'latitude',
            'longitude',
            'map_link',
            [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            'start_time',
            'end_time',
            'start_time_saturday',
            'end_time_saturday',
            'start_time_sunday',
            'end_time_sunday',
//            'start_time_holidays',
//            'end_time_holidays',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
