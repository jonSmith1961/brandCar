<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentBlockVersions */
/* @var $form yii\widgets\ActiveForm */


if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="content-block-versions-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

    <?= Html::a('','',['name' => 'content_id']);?>
    <?= $form->field($model, 'content_id')->textInput() ?>

    <?= Html::a('','',['name' => 'content']);?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
