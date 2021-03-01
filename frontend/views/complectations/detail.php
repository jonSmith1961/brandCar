<?php

use frontend\helpers\ImageHelper;
use yii\helpers\Html;
use common\helpers\File;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View $this
 * @var \backend\models\Complectations $complectation
 * @var array $model
 * @var string $subjectFormValue
 * @var string $cityFormValue
 */


$this->registerCssFile('/css/magnific-popup.css');

$this->registerJsFile('/js/magnific-popup.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);


$this->registerJsFile('/js/swiper.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerJsFile('/js/swiper-complectation-property-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);


$this->registerJsFile('/js/swiper-model-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);


$this->registerCssFile('/css/swiper.css');

?>

<div class="wrapper">
	<div class="clear"></div>
	<div class="page_content">
		<ul class="breadcrumb-navigation"><li><a href="/" title="Главная">Главная</a></li><li><span>&nbsp;&gt;&nbsp;</span></li><li><a href="/models/elf/" title="Модельный ряд и цены">Модельный ряд и цены</a></li></ul>
		<div id="right-content">
			<div class="model-detail">
				<div class="model-detail__row">
					<div class="model-detail__col">
						<?= File::GetResizedImage($complectation->detail_picture, 1000, 665,
							[
								'class'=>"model-detail__img",
							]);?>
						<p class="model-detail__price">
							Цена от: <span><?= number_format($complectation->price, 0, '.', ' ') ?? ''?></span> руб.
						</p>
					</div>
					<div class="model-detail__col">
						<p class="model-detail__name"><?php	echo $complectation->name ?? '';?></p>
						<p class="model-detail__preview-text"><?php
						echo $complectation->brief ?? '';
						?><div class="model-detail__btns">
							<?php

							?>
							<button class="model-detail__order-btn modal__order-form" type="button" name="button">Оформить заказ</button>
								<?php
								if(!empty($complectation->specifications_file)){
									$specificationsFile =  File::getPath($complectation->specifications_file);
									?>
									<a href="<?= $specificationsFile ?? ''?>" class="model-detail__link"  target="_blank" download>
										<?= ImageHelper::show_svg('icon-download-tech', 'model-detail__link-icon') ?>
										Скачать технические характеристики
									</a>
									<?php
								}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="model-detail__anchors">
	<div class="wrapper">
		<a href="#" rel="features" class="model-detail__anchor">Характеристики</a>
		<a href="#" rel="props" class="model-detail__anchor">Особенности</a>
		<a href="#" rel="specials" class="model-detail__anchor">Готовые решения</a>
		<!-- <a href="#" rel="download" class="model-detail__anchor">Скачать</a> -->
	</div>
</div>





<div class="wrapper">
	<div class="page_content">
		<div id="right-content">
			<section id="features" class="model-detail__section">
				<p class="model-detail__title">Основные характеристики</p>
				<div class="model-features">
					<ul class="model-features__list">
						<li class="model-features__item">
							<span class="model-features__name">Полная масса</span>
							<span class="model-features__val"><?= $complectation->property_weight?></span>
						</li>
						<li class="model-features__item">
							<span class="model-features__name">Грузоподъемность</span>
							<span class="model-features__val"><?= $complectation->property_carrying?></span>
						</li>
						<li class="model-features__item">
							<span class="model-features__name">Двигатель</span>
							<span class="model-features__val"><?= $complectation->property_engine?></span>
						</li>
						<li class="model-features__item">
							<span class="model-features__name">Трансмиссия</span>
							<span class="model-features__val"><?= $complectation->property_transmission?></span>
						</li>
						<li class="model-features__item">
							<span class="model-features__name">Привод/ведущие колеса</span>
							<span class="model-features__val"><?= $complectation->property_drive_wheels?></span>
						</li>
					</ul>
				</div>
			</section>
			<?php
			if(!empty($complectation->gallery1_id)){
			$complectationGallery1 = $complectation->gallery1Value;
			?>
			<section id="props" class="model-detail__section">
				<p class="model-detail__title">Особенности</p>
				<div class="model-props swiper-container">
				<div class="swiper-wrapper">
					<?php
					foreach ($complectationGallery1 as $item) {

						$imagePath = $specificationsFile =  File::getPath($item->file_id);
						$image_prev =  File::GetResizedImage($item->file_id, 670, 400, ['class' => 'model-props__img']);
						?>
						<div class="model-props__item swiper-slide">
							<?= $image_prev ?? ''?>
							<div class="model-props__text">
								<div>
									<p class="model-props__title"><?= $item->name ?? ''?></p>
									<p><?= $item->text ?? '' ?></p>

								</div>
								<div class="swiper-pagination model-props__pagination"></div>
							</div>

						</div>
						<?php
					}
					?>

				</div>

				<div class="model-props__navigation">
					<div class="swiper-button-prev model-props__arrow model-props__arrow_prev"></div>
					<div class="swiper-button-next model-props__arrow model-props__arrow_next"></div>
				</div>
				</div>
			</section>



			<?php

			}
			?>


		</div>
	</div>
</div>

<section id="systems" class="model-detail__section model-systems">
	<div class="wrapper">
		<p class="model-systems__title">Автомобиль оборудован необходимыми электронными системами, облегчающими управление и маневрирование</p>
		<div class="model-systems__list">
			<div class="model-systems__item">
				<?= ImageHelper::show_svg('icon-airbag-2', 'model-systems__svg') ?>
				<p class="model-systems__text">Система SRS с подушкой безопасности водителя и ремень с преднатяжителем и ограничителем нагрузки</p>
			</div>
			<div class="model-systems__item">
				<?= ImageHelper::show_svg('icon-car-lights-elf', 'model-systems__svg') ?>
				<p class="model-systems__text">Дневные ходовые огни DLR</p>
			</div>
			<div class="model-systems__item">
				<?= ImageHelper::show_svg('icon-space-2', 'model-systems__svg') ?>
				<p class="model-systems__text">Устройство вызова экстренных оперативных служб «ЭРА-ГЛОНАСС»</p>
			</div>
			<div class="model-systems__item">
				<?= ImageHelper::show_svg('icon-stability', 'model-systems__svg') ?>
				<p class="model-systems__text">Система курсовой устойчивости EVSC (включая антиблокировочную тормозную систему ABS и антипробуксовочную систему ASR)</p>
			</div>
		</div>
	</div>
</section>


<div class="wrapper">
	<div class="page_content">
		<div id="right-content">

			<section id="specials" class="model-detail__section model-specials">
				<div class="model-specials__title-wrapper">
					<p class="model-specials__title">Готовые решения для Вашего бизнеса</p>
				</div>
				<span class="model-specials__credo">Создай свой автомобиль вместе с ISUZU</span>
				<p class="model-specials__text">Мы готовы предложить вам грузовик, подходящий под вашу бизнес задачу</p>
				<div class="model-specials__list">

					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/bort.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Бортовой автомобиль</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/izoterm.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Изотермический фургон</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/prom.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Промтоварный фургон</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/samosval.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Автомобиль-самосвал с трехсторонней разгрузкой</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/buril.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Бурильная машина</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/cisterna.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Автоцистерна</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/evakuator.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Эвакуатор</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/gidropod.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Автогидроподъемник</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/musorovoz.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Мусоровоз</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/pum.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Подметательно-уборочная машина (ПУМ)</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/teh-pomosh.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Автомобиль-эвакуатор технической помощи</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/kmu.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Бортовой автомобиль с краноманипуляторной установкой (КМУ)</span></p>
					</div>
					<div class="model-specials__item">
						<div class="model-specials__img-wrapper">
							<img src="/images/vacuum.jpg" alt="" class="model-specials__img">
						</div>
						<p class="model-specials__name">ELF 3.5 <span>Ассенизационная (вакуумная) машина</span></p>
					</div>
				</div>
			</section>


		</div>
	</div>
</div>

<!-- Форма заказа начало-->

<?php

Pjax::begin([
	'id' => 'conference-form-pjax',
	'enablePushState' => false,
]);
?>
<div class="order-form modal-form" style="display:none;">
	<?php // modal-form
	$form = ActiveForm::begin([
		'id' => 'conference-form',
		'options' => [
			'enctype' => 'multipart/form-data',
			'data' => ['pjax' => 1],
			'novalidate' => 'novalidate',
			'class' => 'conference-form',
		],
		'method' => 'post',
	]);
	echo $form->field($model, 'subject')->hiddenInput(['value' => $subjectFormValue])->label(false);
	echo $form->field($model, 'city')->hiddenInput(['value' => $cityFormValue])->label(false);
	echo $form->field($model, 'formName')->hiddenInput(['value' => 'Оформить заказ'])->label(false);
	?>
		<div class="order-form__close">
			<div class="order-form__close-buttom">+</div>
		</div>
		<div class="order-form__block">
			<div class="order-form__title">Оформить заказ</div>
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
			<div class="conference-form__items-container
                conference-form__items-container_margin">
				<button type="submit" class="conference-form__submit">Отправить заказ</button>
			</div>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

	<div class="overlay-white"></div>
	<!-- Перенесенное поле вывода удачной отправки -->
	<?php
	if (Yii::$app->session->hasFlash('contactFormSubmitted')){

		?>
		<div class="modal-form-success feedback__success">
			<div class="feedback__success_message">
				<p><span class="feedback__success_thanks">Спасибо!</span><br>Ваш заказ принят.</p>
				<button type="button" name="button" class="button__close">+</button>
			</div>
		</div>
		<?php
	}
?>
<?php Pjax::end();?>
<!-- Форма заказа конец-->

<?php
if(!empty($complectation->gallery2_id)){
	$complectationGallery2 = $complectation->gallery2Value;
	?>

	<div class="swiper-container models-gallery ">
		<div class="swiper-wrapper models-gallery__gallery">
			<?php
			foreach ($complectationGallery2 as $item) {

				$imagePath = $specificationsFile =  File::getPath($item->file_id);
				$image_prev =  File::GetResizedImage($item->file_id, 670, 400);
				?>
				<div class="swiper-slide">


					<a href="<?= $imagePath ?? ''?>" class="popup-init">
						<?= $image_prev ?? ''?>
					</a>
				</div>
				<?php
			}
			?>

		</div>


	</div>
	<div class="models-gallery__navigation">
		<div class="swiper-button-prev models-gallery__arrow models-gallery__arrow_prev"></div>
		<div class="swiper-pagination models-gallery__pagination"></div>
		<div class="swiper-button-next models-gallery__arrow"></div>
	</div>




	<?php

}
?>



