<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipient */

$this->title = 'Просмотр группы получателей ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Получатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="recipient-view">

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
//            'center_id',
//            'city_id',
	        [
		        'attribute' => 'cityName',
		        'label' => 'Город',
		        'value'=>function ($data) {
			        return $data->city ? $data->city->name : '';
		        }
	        ],
//            'theme_id',
	        [
		        'attribute' => 'themeName',
		        'label' => 'Тема',
		        'value'=>function ($data) {
			        return $data->theme ? $data->theme->name : '';
		        }
	        ],
            'recipient:ntext',
            	        [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
