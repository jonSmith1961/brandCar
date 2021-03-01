<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;
use backend\models\DealerCenter;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="departments-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= Html::a('','',['name' => 'name']);?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'center_id']);?>
	<?= $form->field($model, 'center_id')->dropDownList(DealerCenter::getAllActiveIdName(), [
		'prompt' => 'Выберите дилерский центр'
	]) ?>

	<?= Html::a('','',['name' => 'phone']);?>
	<?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '+7 (999) 9-999-999',
	]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

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


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
