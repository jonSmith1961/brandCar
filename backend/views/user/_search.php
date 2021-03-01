<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 16.05.2019
 * Time: 16:33
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'name') ?>

<!--    --><?//= $form->field($model, 'lastname') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?php // echo $form_module->field($model, 'password_hash') ?>

    <?php // echo $form_module->field($model, 'password_reset_token') ?>

    <?php // echo $form_module->field($model, 'email') ?>

    <?php // echo $form_module->field($model, 'status') ?>

    <?php // echo $form_module->field($model, 'created_at') ?>

    <?php // echo $form_module->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
