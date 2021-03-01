<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpecialsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specials-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'brief') ?>

    <?= $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'sub_title') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'preview_picture') ?>

    <?php // echo $form->field($model, 'detail_picture') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
