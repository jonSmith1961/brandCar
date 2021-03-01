<?php

use yii\helpers\Html;
use common\helpers\CF;
use backend\models\City;
use common\helpers\File;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use backend\models\Specials;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Specials */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}


		if (!empty($model->errors)) {
			foreach ($model->errors as $key => $error) {
				if(!empty($error)){
					if(is_array($error)){
						if ($key == 'preview_picture'){
//						if ($key == 'preview_picture' || $key == 'detail_picture'){
							if(!empty($error[0])){
								//  field-element-preview_picture
								//'.field-element-preview_picture help-block-error'
								$css_class = 'field-element-'.$key.'';

								$errorMessage = $error[0];

								$JS = "
var field = $('.".$css_class." .help-block-error').text('".$errorMessage."');



";
								$this->registerJS($JS);

							}
						}
					}
				}

			}
		}


?>

<div class="specials-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'alias']);?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= $form->field($model, 'citiesField')->widget(Select2::classname(), [
		'data' => City::getAllActiveIdName(),
		'options' => ['placeholder' => 'Выберите город'],
		'pluginOptions' => [
			'allowClear' => true,
			'multiple' => true
		],
	]);
	?>

	<?= Html::a('','',['name' => 'brief']);?>
	<?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

	<?= Html::a('','',['name' => 'text']);?>
	<?php
	echo $form->field($model, 'text')->widget(CKEditor::class, [
		'clientOptions' => ['allowedContent' => true],
		'preset' => 'full'
	]);
	?>

    <?= $form->field($model, 'sub_title')->textarea(['rows' => 2]) ?>

	<?= Html::a('','',['name' => 'url']);?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

	<?php
	$nameFieldsFile = Specials::$fieldsNamesInputFile;

	foreach ($nameFieldsFile as $fieldName) {

		$rowImage = $model->$fieldName;
		$fieldNamePost = 'Specials['.$fieldName.']';
		$isImage = File::isImage($rowImage);
		$realNameFileRow = '';

		$fieldRealNemeProperty =  $fieldName. '_real_file_name';

		?>
		<?= Html::a('','',['name' => $fieldName]);?>
		<div class="form-group field-element-<?=  $fieldName ?? ''?>">
			<label class="control-label"
				   for="element-preview_picture"><?= $model->attributeLabels()[$fieldName] ?></label>
			<?php
			$required = false;
			if ($fieldName == 'preview_picture') {
				$required = true;
			}
			if($isImage) {
				echo File::ShowResizedImage($rowImage, 200, 125);
			}
			echo '<br>';
			$realNameFileRow = File::getRealName($rowImage);
			$messageInfoFile  = ' '. $realNameFileRow . '  ';

			echo '<br>';
			echo Html::tag('span',$realNameFileRow,['class' => 'la-bel-'.$fieldName]);
			echo '<br>';

			$delFieldNameCheckboxPreviewImages = 'del_'.''.$fieldName;
			if(!empty($realNameFileRow)) {
				echo Html::checkbox($delFieldNameCheckboxPreviewImages, null, [
					'label' => 'Удалить'
				]);
				$required = false;
			}
			$options = ['accept' => 'image/*'];
			if($required){
				$options = ['required' => 'required','accept' => 'image/*'];
			}
			?>
			<?= Html::hiddenInput($fieldNamePost, $rowImage) ?>
			<?= Html::fileInput($fieldNamePost, null, $options) ?>

			<div class="help-block-error"></div>


		</div>
		<?php

	}?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
