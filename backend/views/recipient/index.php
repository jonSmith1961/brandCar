<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RecipientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Получатели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipient-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать группу получателей', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            //'center_id',
	        [
				'attribute' => 'themeName',
				'label' => 'Тема',
				'value'=>'theme.name',
		        'filter' => \backend\models\ThemeMessage::getAllActiveIdName()
			],
	        [
				'attribute' => 'cityName',
				'label' => 'Город',
				'value'=>'city.name',
		        'filter' => \backend\models\City::getAllActiveIdName()
			],
	        [
				'attribute' => 'centerName',
				'label' => 'Дилерский центр',
				'value'=>'center.name',
		        'filter' => \backend\models\DealerCenter::getAllActiveIdName()
			],
            'recipient:ntext',
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
