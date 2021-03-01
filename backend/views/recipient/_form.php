<?php

use yii\helpers\Html;
use common\helpers\CF;
use backend\models\City;
use yii\widgets\ActiveForm;
use backend\models\DealerCenter;
use backend\models\ThemeMessage;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipient */
/* @var $form yii\widgets\ActiveForm */

if (!empty($model->errors)) {
	CF::printError($model, $model->errors);
}

?>

<div class="recipient-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
		</div>
	</div>

	<?= Html::a('','',['name' => 'theme_id']);?>
	<?= $form->field($model, 'theme_id')->dropDownList(ThemeMessage::getAllActiveIdName(), [
		'prompt' => 'Выберите тему'
	]) ?>

	<?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>

	<?= Html::a('','',['name' => 'city_id']);?>
    <?= $form->field($model, 'city_id')->dropDownList(City::getAllActiveIdName(), [
		'prompt' => 'Выберите город'
	]) ?>

	<?= Html::a('','',['name' => 'center_id']);?>
	<?= $form->field($model, 'center_id')->dropDownList(DealerCenter::getAllActiveIdName(), [
		'prompt' => 'Выберите дилерский центр'
	]) ?>

    <?= Html::a('','',['name' => 'recipient']);?>
    <?= $form->field($model, 'recipient')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
