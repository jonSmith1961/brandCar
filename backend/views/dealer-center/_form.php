<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;
use backend\models\City;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\DealerCenter */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="dealer-center-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= Html::a('','',['name' => 'name']);?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'city_id']);?>
    <?= $form->field($model, 'city_id')->dropDownList(City::getAllActiveIdName(), [
		'prompt' => 'Выберите город'
	]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'phone']);?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '+7 (999) 9-999-999',
	]) ?>

	<?= Html::a('','',['name' => 'email']);?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'address']);?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'post_code']);?>
    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'latitude']);?>
    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'longitude']);?>
    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'map_link']);?>
    <?= $form->field($model, 'map_link')->textInput(['maxlength' => true]) ?>

	<?php
	$timeFields = [
		'start_time',
		'end_time',
		'start_time_saturday',
		'end_time_saturday',
		'start_time_sunday',
		'end_time_sunday',
//		'start_time_holidays',
//		'end_time_holidays',
	];

	foreach ($timeFields as $key => $timeField) {

		$timeFieldName = 'DealerCenter['.$timeField.']';

		$showRow = (($key % 2) == 0);

		if($showRow){
			echo '<div class="col-sm-12">';
		}
		?>
		<div class="col-sm-6">
		<?php
		echo Html::a('','',['name' => $timeField]);
		echo $form->field($model, $timeField)->widget(TimePicker::classname(), [
			'name' => $timeFieldName,
			'size' => 'sm',
			'pluginOptions' => [
				'showSeconds' => false,
				'showMeridian' => false,
				'minuteStep' => 10,
				'defaultTime' => false,
			]
		]);?>
		</div>
			<?php
		if(!$showRow){
			echo '</div>';
		}
	}
	?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
