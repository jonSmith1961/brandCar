<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\helpers\File;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ModelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Модели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать модель', ['create'], ['class' => 'btn btn-success']) ?>
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
            'menu_name',
            'title',
            'code',
            //'brief:ntext',
            //'qualities:ntext',
            //'text_preview:ntext',
            //'text_col:ntext',
            //'warranty_year:ntext',
            //'warranty_mileage:ntext',
            //'preview_picture',

	        [
		        'attribute' => 'preview_picture',
		        'label' => 'Превью',
		        'content' => function ($model) {
			        return File::GetResizedImage($model['preview_picture'], 100, 0);
		        }
	        ],
            //'detail_picture',
            //'specifications_file',
            //'catalog_file',
            //'gallery1_id',
            //'gallery2_id',
            'sort',
            //'active',
	        [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
