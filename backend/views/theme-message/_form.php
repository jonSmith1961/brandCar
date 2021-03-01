<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\ThemeMessage */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="theme-message-form">

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

    <?= Html::a('','',['name' => 'theme_crm']);?>
    <?= $form->field($model, 'theme_crm')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
