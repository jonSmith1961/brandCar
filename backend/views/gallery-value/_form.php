<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleryValue */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="gallery-value-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= Html::a('','',['name' => 'galleries_id']);?>
    <?= $form->field($model, 'galleries_id')->textInput() ?>

    <?= Html::a('','',['name' => 'name']);?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= Html::a('','',['name' => 'text']);?>
    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= Html::a('','',['name' => 'property']);?>
    <?= $form->field($model, 'property')->textarea(['rows' => 6]) ?>

    <?= Html::a('','',['name' => 'sort_order']);?>
    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= Html::a('','',['name' => 'file_id']);?>
    <?= $form->field($model, 'file_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
