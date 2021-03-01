<?php

/**
 * @var \yii\web\View $this
 * @var frontend\models\FeedbackForm $model
 * @var string $cityFormValue
 * @var string $subjectFormValue
 */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;


$this->title = 'Обратная связь';


$this->registerJsFile('/js/order-form.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerJsFile('/js/inputmask.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);


?>
<div class="contracts__feedback">
	<div class="contracts__feedback-banner">
		<div class="contracts__feedback-img"></div>
		<div class="order-form" >
			<?php
			Pjax::begin([
				'id' => 'conference-form-pjax',
				'enablePushState' => false,
			]);

			$form = ActiveForm::begin([
				'id' => 'conference-form',
				'options' => [
					'enctype' => 'multipart/form-data',
					'data' => ['pjax' => 1],
					'novalidate' => 'novalidate',
					'class' => 'conference-form',
				],
			]);

			echo $form->field($model, 'city')->hiddenInput(['value' => $cityFormValue])->label(false);
			echo $form->field($model, 'subject')->hiddenInput(['value' => $subjectFormValue])->label(false);
			?>
				<div class="order-form__block">
					<div class="order-form__title"><h1 class="center-red"><span>Обратная связь</span></h1></div>
					<div>
						<div class="order-form__list">
							<div class="order-form__item">
								<?= $form->field($model, 'name')->textInput([
									'class'=>'order-form__type-input',
									'placeholder' => 'ФИО*'
								])->label(false) ?>
							</div>
							<div class="order-form__item">
								<?= $form->field($model, 'phone')->label(false)->widget(\yii\widgets\MaskedInput::className(), [
									'mask' => '+7 (999) 9-999-999',

									'options' => [
										'class'=>'order-form__type-input',
										'placeholder' => 'Телефон*',
									],
								]) ?>
							</div>
							<div class="order-form__item">
								<?= $form->field($model, 'email')->textInput([
									'class'=>'order-form__type-input',
									'placeholder' => 'Email*'
								])->label(false) ?>


							</div>
							<div class="order-form__item">
								<?= $form->field($model, 'comment')->textarea([
									'class'=>'order-form__type-input-textarea  input-textarea',
									'placeholder'=>'Введите сообщение*'
								])->label(false) ?>
								<div class="order-form__label_textarea"></div>
							</div>

							<div class="order-form__item">
								<?= $form->field($model, 'agreement')->checkbox([
									'value' => 'Да',
									'data' => ['required' => 1],
									'required' => 1
								], false)->label(false) ?>
								<?= Html::a('Согласие на обработку персональных данных', Url::toRoute(['/policy/']),['onclick' => "window.open ('".Url::toRoute(['/policy/'])."'); return false",
									'class' => 'agree']);?>
							</div>
						</div>
					</div>
					<div class="conference-form__items-container conference-form__items-container_margin">
						<button type="submit" class="conference-form__submit">Отправить</button>
					</div>

				</div>

				<?php
				if (Yii::$app->session->hasFlash('contactFormSubmitted')){
				$addClass = ' feedback__success_thanks';
				}
				?>
				<div class="feedback__success<?= $addClass ?? ''?>">
					<div class="feedback__success_message">
						<p><span class="feedback__success_thanks">Спасибо!</span><br>Ваш отзыв отправлен.</p>
						<button type="button" name="button" class="button__close">+</button>
					</div>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
		<?php Pjax::end();?>
		<div class="overlay-white"></div>

	</div>
</div>