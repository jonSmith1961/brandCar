<?php

use frontend\helpers\ImageHelper;
use yii\helpers\Html;
use common\helpers\File;
use backend\models\Models;

/**
 * @var \yii\web\View $this
 * @var \backend\models\Models $model
 * @var \backend\models\Complectations $complectationsWeightsArray
 * @var \backend\models\Complectations $complectationsModel
 */

//$this->registerJsFile('/js/init-svg.js', [
//	'depends' => \yii\web\JqueryAsset::class,
//	'position' => yii\web\View::POS_HEAD
//]);

//$this->registerJsFile('/js/init-svg.js', [
//	'depends' => \yii\web\JqueryAsset::class,
//	'position' => yii\web\View::POS_END
//]);

$this->registerCssFile('/css/magnific-popup.css');

$this->registerJsFile('/js/magnific-popup.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerJsFile('/js/swiper.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_BEGIN
]);

$this->registerJsFile('/js/swiper-model-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerCssFile('/css/swiper.css');

$this->registerJsFile('/js/models-filter.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

?>
<div class="wrapper">
	<div class="clear"></div>
	<div class="page_content">
		<ul class="breadcrumb-navigation"><li><a href="/" title="Главная">Главная</a></li><li><span>&nbsp;&gt;&nbsp;</span></li><li><a href="/models/elf/" title="Модельный ряд и цены">Модельный ряд и цены</a></li></ul>      <div id="right-content">



			<!-- <section class="models-header">
			  <p class="models-header__title">Малотоннажная серия ELF</p>
			  <div class="models-header__wrapper">
				<p class="models-header__text">Визитная карточка концерна ISUZU, признанного мирового лидера в области производства и продажи коммерческой техники, а также создания высокотехнологичных дизельных двигателей.  Автомобили ISUZU ELF отличаются маневренностью и лёгкостью в управлении, отлично подходят для работы в плотном городском потоке автомобилей с частыми парковками и погрузками-выгрузками в условиях ограниченного пространства.</p>
				<p class="models-header__text">Первый ELF появился в далеком 1959 году, сегодня с конвейера сходит уже шестое поколение популярного грузовика. Он является одним из главных долгожителей мирового автомобилестроения, модель выпускается уже на протяжении 60 лет, постоянно совершенствуясь, но при этом сохраняя свои лучшие качества.</p>
				<div class="models-header__imgs">
				  <img src="../img/warranty-elf.png" alt="" class="models-header__img">
				  <img src="../img/euro-5.png" alt="" class="models-header__img">
				</div>
			  </div>
			</section> -->

			<section class="models-new-header">
				<h1 class="center-red"><span><?php	echo $model->title ?? '';?></span></h1>
				<div class="models-new-header__wrapper">
					<div class="models-new-header__item models-new-header__item_text">
						<?php
						echo $model->brief ?? '';
						?>
						<div class="warranty-label">
							<span class="warranty-label__caption">Гарантия</span>
							<div class="warranty-label__block">
								<span class="warranty-label__text"><span><?= $model->warranty_year ?? '' ?></span> года или <span><?= $model->warranty_mileage ?? ''?></span> км<sup>*</sup></span>
								<span class="warranty-label__subtext">в зависимости от того, что наступит ранее</span>
							</div>
						</div>
					</div>
					<div class="models-new-header__item">
						<?= File::GetResizedImage($model->detail_picture, 700, 450,
							[
									'class'=>"models-new-header__banner",
							]);?>
					</div>
				</div>
			</section>

		</div>

	</div>
</div>

<div class="wrapper">
	<div class="page_content">

		<section class="models-links">
			<?php
			if(!empty($model->specifications_file)){
				$specificationsFile =  File::getPath($model->specifications_file);
				?>
				<a href="<?= $specificationsFile ?? ''?>" class="models-links__item" download>
					<?= ImageHelper::show_svg('icon-download-tech', 'models-icon models-links__icon') ?>
					<span>Скачать технические характеристики модельного ряда ISUZU</span>
				</a>
				<?php
			}

			if(!empty($model->catalog_file)){
				$catalogFile =  File::getPath($model->catalog_file);
				?>
				<a href="<?= $catalogFile ?? ''?>" class="models-links__item" target="_blank">
					<?= ImageHelper::show_svg('icon-pdf-range', 'models-icon models-links__icon') ?>
					<span>Скачать каталог</span>
				</a>
				<?php
			}
			?>
		</section>

		<section class="models-feature">
			<p class="models-feature__title">Особенности</p>
			<ul class="models-feature__list">
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-curves', 'models-icon models-feature__icon') ?>
					<span>Высокая маневренность</span>
				</li>
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-steering-wheel', 'models-icon models-feature__icon') ?>
					<span>Легкость в управлении</span>
				</li>
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-building', 'models-icon models-feature__icon') ?>
					<span>Идеален для города</span>
				</li>
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-filter', 'models-icon models-feature__icon') ?>
					<span>Без мочевины и сажевого фильтра</span>
				</li>
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-shield', 'models-icon models-feature__icon') ?>
					<span>Повышенная безопасность</span>
				</li>
				<li class="models-feature__item">
					<?= ImageHelper::show_svg('icon-car-engine', 'models-icon models-feature__icon') ?>
					<span>Надежный высокоэффективный дизельный двигатель</span>
				</li>
			</ul>
		</section>
	</div>
</div>
<div id="models__fetch-content">
	<section class="models-filter">
		<div class="models-filter__wrapper">
			<?= Html::dropDownList('models-filter__select', null, $complectationsWeightsArray, ['prompt' => 'Выберите массу','value' => 'none', 'class' => 'models-filter__select', 'label' => 'Select']) ?>
			<?= ImageHelper::show_svg('icon-next', 'models-icon models-filter__icon') ?>
		</div>
	</section>
	<div class="wrapper">
		<div class="page_content">
			<section class="models-list">
				<?php
				foreach ($complectationsModel as $key => $complectation) {
					$weigthClass = 'weight-'.$complectation->weight;

					if($key === 0){
						$weigthClass .= ' weight-all';
					}
					?>
					<div class="model <?= $weigthClass ?? ''?>">
						<div class="model__wrapper">
							<div class="model__info">
								<p class="model__title">
									<?= $complectation->title?><span class="model__series">(<?= mb_strtoupper($complectation->code)?>)</span>
								</p>
								<p class="model__preview"><?php
								echo $complectation->brief

									?>

								</p>
							</div>

							<div class="model__img-wrapper">

								<?= File::GetResizedImage($complectation->preview_picture, 1000, 665,
									[
										'class'=>"model__img",
									]);?>
							</div>
						</div>
						<div class="model-features">
							<p class="model-features__title">Основные характеристики</p>
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
						<!-- <a href="/models/elf/elf-5-5-4x4/" class="model__btn">Подробнее</a> -->
						<?php
						$url = '/complectations/'.$complectation->series.'/';
						?>
						<a href="<?= $url?>" class="model__btn">Подробнее</a>
						<!-- <a href="detail.php?code=elf-5-5-4x4" class="model__btn">Подробнее</a> -->
					</div>
					<?php
				}
				?>

			</section>
		</div>
	</div>
</div>

<?php
if(!empty($model->gallery1_id)){
	$modelGallery1 = $model->gallery1Value;
	?>
	<div class="swiper-container models-gallery ">
		<div class="swiper-wrapper models-gallery__gallery">
			<?php
			foreach ($modelGallery1 as $item) {

				$imagePath = $specificationsFile =  File::getPath($item->file_id);
				$image_prev =  File::GetResizedImage($item->file_id, 640, 400);
				?>
				<div class="swiper-slide">
					<a href="<?=$imagePath ?? ''?>" class="popup-init">
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


<div class="wrapper">
	<div class="page_content">


		<div class="models-text">
			<div class="models-text__preview">
				<p>При проектировании грузовика серии ELF перед командой инженеров ISUZU стояла задача создать эффективный инструмент для профессионала, простой грузовой автомобиль функциональный как внутри, так и снаружи. Официальный дистрибьютор ИСУЗУ в России решает еще одну задачу – купить авто по цене от производителя.</p>
			</div>
			<div class="models-text__row">
				<div class="models-text__col">
					<p class="models-text__title">Особенности автомобилей серии ISUZU ELF</p>
					<p>Автомобили ISUZU (ИСУДЗУ) серии «Эльф» отличаются высокой маневренностью и легкостью в управлении, подходят для динамичной езды по городским автомагистралям и путешествий на длительные расстояния по пересечённой местности.</p>
					<p>Все автомобили ИСУЗУ отличаются повышенной безопасностью. Серия ELF не исключение, очень жесткая кабина обеспечивает высочайший уровень защиты среди автомобилей с компоновкой «кабина над двигателем». Усиленные двери и каркас повышенной жесткости обеспечивают целостность кабины, образуя защитный кокон, что сокращает травматизм в случае ДТП. Грузовик ISUZU ELF имеет широкое поле обзора с водительского места, что способствует постоянному контролю водителя за дорожной обстановкой.</p>
				</div>
				<div class="models-text__col">
					<p class="models-text__title">Автомобили ISUZU ELF от официального дистрибьютора</p>
					<p>Автомобили ISUZU (ИСУДЗУ) серии «Эльф» отличаются высокой маневренностью и легкостью в управлении, подходят для динамичной езды по городским автомагистралям и путешествий на длительные расстояния по пересечённой местности.</p>
					<p>Все автомобили ИСУЗУ отличаются повышенной безопасностью. Серия ELF не исключение, очень жесткая кабина обеспечивает высочайший уровень защиты среди автомобилей с компоновкой «кабина над двигателем». Усиленные двери и каркас повышенной жесткости обеспечивают целостность кабины, образуя защитный кокон, что сокращает травматизм в случае ДТП. Грузовик ISUZU ELF имеет широкое поле обзора с водительского места, что способствует постоянному контролю водителя за дорожной обстановкой.Официальный дистрибьютор автомобилей ISUZU реализует грузовики линейки ELF через официальную дилерскую сеть. Каталог на сайте предлагает широкий выбор автомобилей полной массой - 3.5 т., 5.2 т., 7.5 т и 9.5 т., где Вы можете ознакомиться с ценами и техническими характеристиками моделей ИСУЗУ ЭЛЬФ. Ассортимент надстроек на шасси ISUZU ELF огромен, мы поможем подобрать Вам наиболее подходящий вариант по выгодной цене.</p>
					<p>Купить грузовик ISUZU ELF (с пробегом или новый) Вы можете у официального дилера в своем городе. И будьте уверены, с таким автомобилем Вы в надёжности и безопасности в любых условиях.</p>
				</div>
			</div>
		</div>




		<!-- end of wrapper -->
	</div>





	<div id="ajax-content"></div>
	<!-- </div> -->

	<!-- </div> -->
</div>


