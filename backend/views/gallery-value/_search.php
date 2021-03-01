<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleryValueSearch */
/* @var $form yii\widgets\ActiveForm */


if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="gallery-value-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'galleries_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'property') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <?php // echo $form->field($model, 'file_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
