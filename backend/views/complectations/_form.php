<?php

use yii\helpers\Html;
use common\helpers\File;
use backend\models\Models;
use yii\widgets\ActiveForm;
use common\helpers\CF;
use yii\helpers\ArrayHelper;
use backend\models\Galleries;
use dosamigos\ckeditor\CKEditor;
use backend\models\Complectations;
use common\helpers\FieldHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Complectations */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

if (!empty($model->errors)) {
	foreach ($model->errors as $key => $error) {
		if(!empty($error)){
			if(is_array($error)){
				if ( in_array($key, Complectations::$fieldsNamesInputFile)){
					if(!empty($error[0])){
						$css_class = 'field-element-'.$key.'';
						$label_id = 'label-'.$key.'';
						$delFieldNameCheckboxPreviewClass = 'del_'.''.$key;
						$errorMessage = $error[0];

						$JS = "
var field = $('.".$css_class." .help-block-error').text('".$errorMessage."');


$('.".$delFieldNameCheckboxPreviewClass."').show();
";
						$this->registerJS($JS);
						//$('.".$label_id."').empty();
					}
				}
			}
		}

	}
}

$JS = "
console.log('model_id_sort_blocks');
$('.model_id_sort_blocks').hide();

var el_start =  $('#complectations-model_id').val();
$('.model_id_'+el_start).show();

$('#complectations-model_id').change(function (e) {
	 var el = $(this).val();
	 console.log(el);
	 $('.model_id_sort_blocks').hide();
    $('.model_id_'+el).show();
});

";
$this->registerJS($JS);

?>

<div class="complectations-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'model_id')->dropDownList(Models::getAllActiveIdName(), [
		'prompt' => 'Выберите модель'
	]) ?>

	<?= Html::a('','',['name' => 'title']);?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'code']);?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'series']);?>
    <?= $form->field($model, 'series')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'brief']);?>
	<?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>
	<?php
//	echo $form->field($model, 'brief')->widget(CKEditor::class, [
//		'clientOptions' => ['allowedContent' => true],
//		'preset' => 'full'
//	]);
	?>

	<?php //echo  $form->field($model, 'qualities')->textarea(['rows' => 6]) ?>


	<?php
	$nameFieldsFile = Complectations::$fieldsNamesInputFile;

	foreach ($nameFieldsFile as $fieldName) {

		$rowImage = $model->$fieldName;
		$fieldNamePost = 'Complectations['.$fieldName.']';
		$isImage = File::isImage($rowImage);

		$fieldRealNemeProperty =  $fieldName. '_real_file_name';

		?>
		<?= Html::a('','',['name' => $fieldName]);?>
		<div class="form-group field-element-<?=$fieldName ?? ''?>">
			<label class="control-label"
				   for="element-<?= $fieldName ?? ''?>"><?= $model->attributeLabels()[$fieldName] ?></label>
			<?php
			$realNameFileRow = File::getRealName($rowImage);
			$messageInfoFile  = ' '. $realNameFileRow . '  ';

//			Html::fileInput($fieldNamePost, null, ['required' => $required, 'accept' => 'image/*']) ;
			$inputPeoperty = [];
			$required = 'required';
			$imageType = 'image/*';

			$isRequired = FieldHelper::isRequired($model, $fieldName);
			$isImageField = FieldHelper::isImageField($fieldName);

			if($isRequired){
				if (empty($realNameFileRow)){
					$inputPeoperty['required'] = $required;
				}
			}

			if($isImageField){
				$inputPeoperty['accept'] = $imageType;
			}

			echo '<br>';
			echo Html::tag('span',$realNameFileRow,['class' => 'label-'.$fieldName]);
			echo '<br>';


			if($isImage) {
				echo File::ShowResizedImage($rowImage, 200, 125);
			}
			echo '<br>';



			if(!empty($realNameFileRow)) {
				$delFieldNameCheckboxPreviewImages = 'del_' . '' . $fieldName;
				echo Html::tag('div',
					Html::checkbox($delFieldNameCheckboxPreviewImages, null, [
						'label' => 'Удалить',

					]),
					[
						'class' => $delFieldNameCheckboxPreviewImages,
					]
				);
			}

			?>
			<?= Html::hiddenInput($fieldNamePost, $rowImage) ?>
			<?= Html::fileInput($fieldNamePost, null, $inputPeoperty) ?>
			<div class="help-block-error"></div>
		</div>
		<?php

	}
	?>
	<div class="col-sm-12">
		<div class="col-sm-6">
    		<?= $form->field($model, 'weight')->textInput() ?>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="col-sm-6">
			<?= $form->field($model, 'sort')->textInput() ?>
		</div>
		<div class="col-sm-6">
			<?php
			$complectationsSorts = Yii::$app->db->createCommand("select model_id, array_to_string(array_agg(sort), ',')
from complectations
group by model_id;")
				->queryAll();
			$ordersComplectationsByModel = ArrayHelper::map($complectationsSorts,'model_id', 'array_to_string');
			?>
			<?php
			if(!empty($ordersComplectationsByModel)){
				foreach ($ordersComplectationsByModel as $key => $items) {
					$valuesString = '';
					$array = explode(',',$items);
					rsort($array);
					$valuesString = implode(',',$array);
					?><span class="model_id_sort_blocks model_id_<?=$key?>" style="display: none">Занятые номера сортировки комплектаций, для текущей модели<br> <?= $valuesString?></span><?php
				}
			}
			?>
		</div>
	</div>

	<div class="col-sm-12">
		<div class="col-sm-6">
			<?= $form->field($model, 'property_weight')->textarea(['rows' => 4]) ?>
		</div>
		<div class="col-sm-6">
			<?= $form->field($model, 'property_carrying')->textarea(['rows' => 4]) ?>
		</div>
	</div>

	<div class="col-sm-12">
		<div class="col-sm-6">
			<?= $form->field($model, 'property_engine')->textarea(['rows' => 4]) ?>
		</div>
		<div class="col-sm-6">
			<?= $form->field($model, 'property_transmission')->textarea(['rows' => 4]) ?>
		</div>
	</div>

	<div class="col-sm-12">
		<div class="col-sm-6">
			<?= $form->field($model, 'property_drive_wheels')->textarea(['rows' => 4]) ?>
		</div>
	</div>


    <?php //echo  $form->field($model, 'text_preview')->textarea(['rows' => 4]) ?>

	<?php //echo  $form->field($model, 'text_col')->textarea(['rows' => 4]) ?>

	<?= $form->field($model, 'gallery1_id')->dropDownList(ArrayHelper::map(Galleries::find()->all(), 'id', 'name'), [
		'prompt' => 'Выберите галерею'
	]) ?>

	<?= $form->field($model, 'gallery2_id')->dropDownList(ArrayHelper::map(Galleries::find()->all(), 'id', 'name'), [
		'prompt' => 'Выберите галерею'
	]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
