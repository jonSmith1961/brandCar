<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\DealerCenterSearch */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="dealer-center-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cityName') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'post_code') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'map_link') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'start_time_saturday') ?>

    <?php // echo $form->field($model, 'end_time_saturday') ?>

    <?php // echo $form->field($model, 'start_time_sunday') ?>

    <?php // echo $form->field($model, 'end_time_sunday') ?>

    <?php // echo $form->field($model, 'start_time_holidays') ?>

    <?php // echo $form->field($model, 'end_time_holidays') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
