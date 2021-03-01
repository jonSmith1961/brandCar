<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\File;

/* @var $this yii\web\View */
/* @var $model backend\models\Complectations */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплектации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="complectations-view">

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
            'price',
	        [
		        'attribute' => 'modelName',
		        'label' => 'Модель',
		        'value'=>function ($data) {
			        return $data->model ? $data->model->name : '';
		        }
	        ],
            'title',
            'code',
            'series',
//            'brief:ntext',
	        [
		        'attribute' => 'brief',
		        'format' => 'html',
	        ],
            'qualities:ntext',
//            'preview_picture',
	        [
		        'attribute' => 'preview_picture',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->preview_picture);
		        },
	        ],
//            'detail_picture',
	        [
		        'attribute' => 'detail_picture',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->detail_picture);
		        },
	        ],
//            'specifications_file',
	        [
		        'attribute' => 'specifications_file',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->specifications_file);
		        },
	        ],
            'weight',
            'sort',
            'property_weight:ntext',
            'property_carrying:ntext',
            'property_engine:ntext',
            'property_transmission:ntext',
            'property_drive_wheels:ntext',
            'text_preview:ntext',
            'text_col:ntext',
//            'gallery1_id',
	        [
		        'attribute' => 'gallery1_id',
		        'value'=>function ($data) {
			        return $data->gallery1 ? $data->gallery1->name : '';
		        }
	        ],
//            'gallery2_id',
	        [
		        'attribute' => 'gallery2_id',
		        'value'=>function ($data) {
			        return $data->gallery2 ? $data->gallery2->name : '';
		        }
	        ],
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
