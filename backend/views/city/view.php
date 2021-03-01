<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="city-view">

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
            'code',
            //'social:ntext',
	        [
		        'attribute' => 'social',
		        'format' => 'html',

		        'value' => function ($data) {
			        $html = '';
			        if(!empty($data->social)) {
				        foreach ($data->social as $rows) {
				        	 foreach ($rows as $key => $value) {
						         $html .= ' '.$key.': ' . $value . ' ';
					         }
					        $html .= ' <br>';
				        }
			        }
			        return $html ;
		        },
	        ],
            'phone',
            'email:email',
            'phone_support',
            [
		        'attribute' => 'active',
		        'filter' => [1 => 'Да', 0 => 'Нет'],
		        'value' => function ($data) {
			        return $data->active ? 'Да' : 'Нет';
		        }
	        ],
            //'created_at',
            //'updated_at',
        ]
    ]) ?>

</div>
