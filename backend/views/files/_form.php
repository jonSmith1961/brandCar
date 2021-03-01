<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\Files */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="file-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= $form->field($model, 'original_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
