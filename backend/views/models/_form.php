<?php

use backend\models\Models;
use common\helpers\CF;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use common\helpers\File;
use common\helpers\FieldHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */
/* @var $form yii\widgets\ActiveForm */


if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}


if (!empty($model->errors)) {
	foreach ($model->errors as $key => $error) {
		if(!empty($error)){
			if(is_array($error)){
				if ( in_array($key, Models::$fieldsNamesInputFile)){
					if(!empty($error[0])){
						$css_class = 'field-element-'.$key.'';
						$label_id = 'label-'.$key.'';
						$delFieldNameCheckboxPreviewClass = 'del_'.''.$key;
						$errorMessage = $error[0];

						$JS = "
var field = $('.".$css_class." .help-block-error').text('".$errorMessage."');


$('.".$delFieldNameCheckboxPreviewClass."').show();
";
						//$('.".$label_id."').empty();
						$this->registerJS($JS);
					}
				}
			}
		}

	}
}


?>

<div class="models-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'brief']);?>
	<?php
	echo $form->field($model, 'brief')->widget(CKEditor::class, [
		'clientOptions' => ['allowedContent' => true],
		'preset' => 'full'
	]);
	?>

    <?= $form->field($model, 'qualities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text_preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text_col')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'warranty_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warranty_mileage')->textInput(['maxlength' => true]) ?>

	<?php
	$nameFieldsFile =  Models::$fieldsNamesInputFile;

	foreach ($nameFieldsFile as $fieldName) {

			$rowImage = $model->$fieldName;
			$fieldNamePost = 'Models['.$fieldName.']';
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

				echo '<br>';
				echo Html::tag('span',$realNameFileRow,['class' => 'la-bel-'.$fieldName]);
				echo '<br>';

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

	}?>


	<?= $form->field($model, 'gallery1_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Galleries::find()->all(), 'id', 'name'), [
		'prompt' => 'Выберите галерею'
	]) ?>

	<?= $form->field($model, 'gallery2_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Galleries::find()->all(), 'id', 'name'), [
		'prompt' => 'Выберите галерею'
	]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
