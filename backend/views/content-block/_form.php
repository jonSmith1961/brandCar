<?php

use backend\models\City;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentBlock */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="content-block-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>
	<?= Html::a('','',['name' => 'name']);?>
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'code']);?>
	<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>


	<?= $form->field($model, 'citiesField')->widget(Select2::classname(), [
		'data' => City::getAllActiveIdName(),
		'options' => ['placeholder' => 'Выберите город'],
		'pluginOptions' => [
			'allowClear' => true,
			'multiple' => true
		],
	]);
	?>

	<?= Html::a('','',['name' => 'content']);?>
	<?php
	echo $form->field($model, 'content')->widget(CKEditor::class, [
		'clientOptions' => ['allowedContent' => true],
		'preset' => 'full'
	]);
	?>

	<div class="form-group">
		<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success editor-button', 'name' => 'submit_form', 'value' => 'Save']) ?>
		<?php
		if (!$model->isNewRecord) {
			echo Html::submitButton('Сохранить версию', ['class' => 'btn btn-primary right', 'name' => 'submit_form', 'value' => 'SaveVersion']);
		}
		?>
	</div>

    <?php ActiveForm::end(); ?>

</div>
