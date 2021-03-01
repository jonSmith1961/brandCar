<?php
/**
 * $form
 * $modelsGalleryValue
 */

/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsGalleryValue GalleryValue */

use yii\helpers\Html;
use yii\jui\JuiAsset;
use common\helpers\File;
use backend\models\Files;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\GalleryValue;

?>

	<div id="panel-option-values" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-check-square-o"></i>Изображкния галереи</h3>
		</div>

		<?php DynamicFormWidget::begin([
			'widgetContainer' => 'dynamicform_wrapper',
			'widgetBody' => '.form-options-body',
			'widgetItem' => '.form-options-item',
			'min' => 1,
			'insertButton' => '.add-item',
			'deleteButton' => '.delete-item',
			'model' => $modelsGalleryValue[0],
			'formId' => 'dynamic-form',
			'formFields' => [
				'name',
				'img'
			],
		]); ?>

		<table class="table table-bordered table-striped margin-b-none">
			<thead>
			<tr>
				<th style="width: 90px; text-align: center"></th>
				<th class="required">Название</th>
				<th style="width: 188px;">url</th>
				<th style="width: 188px;">Текст</th>
				<th style="width: 188px;">Изображение</th>
				<th style="width: 90px; text-align: center">Действия</th>
			</tr>
			</thead>
			<tbody class="form-options-body">
			<?php foreach ($modelsGalleryValue as $index => $modelGalleryValue): ?>
				<tr class="form-options-item">
					<td class="sortable-handle text-center vcenter" style="cursor: move;">
						<i class="fa fa-arrows"></i>
					</td>
					<td class="vcenter">
						<?= $form->field($modelGalleryValue, "[{$index}]name")->label(false)->textInput(['maxlength' => 128]); ?>
					</td>
					<td class="vcenter">
						<?= $form->field($modelGalleryValue, "[{$index}]url")->label(false)->textInput(['maxlength' => 128]); ?>
					</td>
					<td class="vcenter">
						<?= $form->field($modelGalleryValue, "[{$index}]text")->label(false)->textarea(['rows' => 6]); ?>
					</td>
					<td>
						<?php if (!$modelGalleryValue->isNewRecord): ?>
							<?= Html::activeHiddenInput($modelGalleryValue, "[{$index}]id"); ?>
							<?= Html::activeHiddenInput($modelGalleryValue, "[{$index}]file_id"); ?>
							<?= Html::activeHiddenInput($modelGalleryValue, "[{$index}]deleteImg"); ?>
						<?php endif; ?>
						<?php
						$modelImage = Files::findOne(['id' => $modelGalleryValue->file_id]);
						$initialPreview = [];
						$relaFileName = null;
						$required = true;
						if ($modelImage) {
							$required = false;
							$fileName = File::src($modelImage->filename);
							$relaFileName = File::getRealName($modelGalleryValue->file_id);
							$initialPreview[] = Html::img($fileName, ['class' => 'file-preview-image']);
							echo File::GetResizedImage($modelGalleryValue->file_id, 100, 0);
							/*?>
							<label class="control-label"
								   for="element-preview_picture"><?= $relaFileName ?? '' ?></label>
							<?php*/
							// Html::activeInput('file',$modelGalleryValue, "[{$index}]img",['required' => $required, 'accept' => 'image/*'])
						}
						?>


						<?= $form->field($modelGalleryValue, "[{$index}]img")->fileInput(['required' => $required, 'accept' => 'image/*'])->label(''.$relaFileName.'')?>
					</td>
					<td class="text-center vcenter">
						<button type="button" class="delete-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="6"></td>
				<td><button type="button" class="add-item btn btn-success btn-sm"><span class="fa fa-plus"></span> Добавить </button></td>
			</tr>
			</tfoot>
		</table>
		<?php DynamicFormWidget::end(); ?>
	</div>

<?php
$js = <<<'JS'

$(".optionvalue-img").on("filecleared", function(event) {
    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;
    var id = event.target.id;
    var matches = id.match(regexID);
    if (matches && matches.length === 4) {
        var identifiers = matches[2].split("-");
        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");
    }
});

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".form-options-body").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.6,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();

jQuery("#dynamic-form").on("click", ".add-item", function(e) {
	console.log('add-item');
	jQuery(".form-options-item img").last().attr("src", "");
	jQuery(".form-options-item .control-label").last().empty();
	
	jQuery(".form-options-item input:file").last().attr("required", "required");
});

JS;

JuiAsset::register($this);
$this->registerJs($js);
?>