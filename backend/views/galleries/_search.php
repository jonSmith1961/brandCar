<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\CF;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleriesSearch */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="galleries-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
