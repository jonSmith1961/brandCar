<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplectationsSearch */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="complectations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'model_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'qualities') ?>

    <?php // echo $form->field($model, 'preview_picture') ?>

    <?php // echo $form->field($model, 'detail_picture') ?>

    <?php // echo $form->field($model, 'specifications_file') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'property_weight') ?>

    <?php // echo $form->field($model, 'property_carrying') ?>

    <?php // echo $form->field($model, 'property_engine') ?>

    <?php // echo $form->field($model, 'property_transmission') ?>

    <?php // echo $form->field($model, 'property_drive_wheels') ?>

    <?php // echo $form->field($model, 'text_preview') ?>

    <?php // echo $form->field($model, 'text_col') ?>

    <?php // echo $form->field($model, 'gallery1_id') ?>

    <?php // echo $form->field($model, 'gallery2_id') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
