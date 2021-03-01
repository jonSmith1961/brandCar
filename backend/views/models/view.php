<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\File;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="models-view">

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
            'menu_name',
            'title',
            'code',
//            'brief:ntext',
	        [
		        'attribute' => 'brief',
		        'format' => 'html',
	        ],
            'qualities:ntext',
            'text_preview:ntext',
            'text_col:ntext',
            'warranty_year:ntext',
            'warranty_mileage:ntext',
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
//            'catalog_file',
	        [
		        'attribute' => 'catalog_file',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->catalog_file);
		        },
	        ],
//			'specifications_file',
	        [
		        'attribute' => 'specifications_file',
		        'format' => 'html',
		        'value' => function ($model) {
			        return File::getRealName($model->specifications_file);
		        },
	        ],
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
            'sort',
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
