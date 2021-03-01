<?php

use common\helpers\File;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Models;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplectationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комплектации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать комплектацию', ['create'], ['class' => 'btn btn-success']) ?>
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
            'price',
//            'model_id',
	        [
				'attribute' => 'modelField',
				'label' => 'Модель',
				'value'=>'model.name',
				'filter' => Models::getAllActiveIdName()
			],
            'title',
            'series',
//            'code',
            //'brief:ntext',
            //'qualities:ntext',
            //'preview_picture',
            //'detail_picture',
            //'specifications_file',
//            'weight',
	        [
		        'attribute' => 'preview_picture',
		        'label' => 'Превью',
		        'content' => function ($model) {
			        return File::GetResizedImage($model['preview_picture'], 100, 0);
		        }
	        ],
	        [
		        'attribute' => 'weight',
		        'label' => 'Масса',
		        'filter' => \backend\models\Complectations::getAllWeight()
	        ],
            'sort',
            //'property_weight:ntext',
            //'property_carrying:ntext',
            //'property_engine:ntext',
            //'property_transmission:ntext',
            //'property_drive_wheels:ntext',
            //'text_preview:ntext',
            //'text_col:ntext',
            //'gallery1_id',
            //'gallery2_id',
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
