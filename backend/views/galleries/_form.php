<?php

/* @var $model backend\models\Galleries */
/* @var $modelGalleries backend\models\Galleries */
/* @var $modelsGalleryValue backend\models\GalleryValue */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use backend\models\City;
use common\helpers\CF;


if (!empty($modelGalleries->errors)) {
	CF::printError($modelGalleries, $modelGalleries->errors);
}

if (!empty($modelsGalleryValue)) {
	foreach ($modelsGalleryValue as $keyRow => $modelGalleryValueRow) {
		if (!empty($modelGalleryValueRow->errors)) {
			CF::p($modelGalleryValueRow->errors);
			foreach ($modelGalleryValueRow->errors as $key => $error) {
				if(!empty($error)){
					if(is_array($error)){
						if ($key == 'file_id'){
							if(!empty($error[0])){
								$css_class = 'field-galleryvalue-'.$keyRow.'-img';

								$JS = "

var field = $('.".$css_class." p.help-block-error').text('Необходимо заполнить «Изображение», проверьте тип файла.');
var parent = $('.".$css_class."').parent('td');


//$('.form-options-item img').last().attr('src', '');
parent.find('img').attr('src', '');
	//$('.form-options-item .control-label').last().empty();
	parent.find('.control-label').empty();

    $('.car-detail__photos-num').on('click', function() {
        $('.car-detail__photos-item').trigger('click');
    });
";
								$this->registerJS($JS);
							}
						}
					}
				}

			}

			$text = '<p class="help-block help-block-error">Необходимо заполнить «Изображение», проверьте тип файла .</p>';
		}
	}

}

?>

<div class="galleries-form">



	<?php $form = ActiveForm::begin([
		'enableClientValidation' => false,
		'enableAjaxValidation' => true,
		'validateOnChange' => true,
		'validateOnBlur' => false,
		'options' => [
			'enctype' => 'multipart/form-data',
			'id' => 'dynamic-form'
		]
	]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

	<?= Html::a('','',['name' => 'name']);?>
    <?= $form->field($modelGalleries, 'name')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'title']);?>
    <?= $form->field($modelGalleries, 'title')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'group']);?>
    <?= $form->field($modelGalleries, 'group')->textInput(['maxlength' => true]) ?>

	<?= Html::a('','',['name' => 'code']);?>
    <?= $form->field($modelGalleries, 'code')->textInput(['maxlength' => true]) ?>

	<?= $form->field($modelGalleries, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= $form->field($modelGalleries, 'citiesField')->widget(Select2::classname(), [
		'data' => City::getAllActiveIdName(),
		'options' => ['placeholder' => 'Выберите город'],
		'pluginOptions' => [
			'allowClear' => true,
			'multiple' => true
		],
	]);
	?>

	<div class="padding-v-md">
		<div class="line line-dashed"></div>
	</div>

	<?= $this->render('_form_option_values', [
		'form' => $form,
		'modelGalleries' => $modelGalleries,
		'modelsGalleryValue' => $modelsGalleryValue
	]) ?>

	<div class="form-group">
		<?= Html::submitButton($modelGalleries->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>