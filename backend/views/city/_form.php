<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\City */
/* @var $form yii\widgets\ActiveForm */


if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}
?>

<div class="city-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= Html::a('','',['name' => 'name']);?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'code']);?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?php
	echo $form->field($model, 'social')->widget(MultipleInput::className(), [
		'max'               => 6,
		'min'               => 1, // should be at least 2 rows
		'columns' => [
			[
				'name'  => 'socials_name',
				'title' => 'Название',
				'enableError' => true,
				'options' => [
					'class' => 'input-priority'
				]
			],
			[
				'name'  => 'socials_code',
				'title' => 'Код',
				'enableError' => true,
				'options' => [
					'class' => 'input-priority'
				]
			],
			[
				'name'  => 'socials_url',
				'title' => 'URL',
				'enableError' => true,
				'options' => [
					'class' => 'input-priority'
				]
			],
			[
				'name'  => 'socials_sort',
				'title' => 'Порядок',
				'enableError' => true,
				'options' => [
					'class' => 'input-priority'
				]
			],
		],
		'allowEmptyList'    => false,
		'enableGuessTitle'  => true,
		'addButtonPosition' => MultipleInput::POS_ROW, // show add button in the header
	])
//		->label(true)
	;
	?>

   	<?= Html::a('','',['name' => 'phone']);?>
    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '+7 (999) 9-999-999',
	]) ?>

    <?= Html::a('','',['name' => 'email']);?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'phone_support']);?>
    <?= $form->field($model, 'phone_support')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
