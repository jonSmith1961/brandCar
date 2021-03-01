<?php

/**
 * @var View $this
 * @var \backend\models\GalleryValue $mainPageTopGalleryValues
 * @var \backend\models\Specials $mainPageSpecials
 * @var \backend\models\News $mainPageNews
 * @var \backend\models\Models $models
 */

use frontend\helpers\ImageHelper;
use yii\web\View;

$this->title = 'Главная';



$this->registerJsFile('/js/swiper.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_BEGIN
]);

$this->registerJsFile('/js/swiper-gallery-top-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerJsFile('/js/swiper-main-specials-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

$this->registerCssFile('/css/swiper.css');

?>
<?= $this->render('in/_main-page__main-slider', compact('mainPageTopGalleryValues'));?>

<div class="main-page">
	<section class="main-page__block">
		<div class="main-page__content">
			<h2 class="main-page__title">Модельный ряд</h2>
			<?= $this->render('in/_main-page__models', compact('models'));?>
		</div>
	</section>
	<section class="main-page__block main-page__block_actions">
		<div class="main-page__content">
			<h2 class="main-page__title main-page__title_white">Акции</h2>
			<?= $this->render('in/_main-page__specials', compact('mainPageSpecials'));?>
		</div>
	</section>

	<section class="main-page__block">
		<div class="main-page__content main-page__content_news">
			<h2 class="main-page__title">Новости</h2>
			<?= $this->render('in/_main-page__news', compact('mainPageNews'));?>
		</div>
	</section>
	<section class="main-page__block main-page__block_no-content">
		<div class="main-isuzu">
			<div class="main-isuzu__divider"></div>
			<p class="main-isuzu__text"><span class="main-isuzu__text_red"><img class="main-isuzu__logo" src="/images/svg/compony-logo.svg" alt="АГАТ"></span><span style="vertical-align: top;"> - Официальный дилер «ISUZU»</span></p>
			<div class="main-isuzu__divider"></div>
		</div>
	</section>

	<section class="main-page__block">
		<div class="main-features__list">
			<div class="main-features__item">
				<div class="main-features__caption">
					<?= ImageHelper::show_svg('main-award', 'main-features__icon icon-quality') ?>
					<p class="main-features__title">Качество</p>
				</div>
				<p class="main-features__text">ISUZU («Исузу») – это качество, проверенное временем. Грузовики и пикапы японской марки пользуются заслуженной популярностью у автолюбителей и опытных водителей со всего мира.</p>
			</div>

			<div class="main-features__item">
				<div class="main-features__caption">
					<?= ImageHelper::show_svg('main-wallet', 'main-features__icon icon-profitable_price') ?>
					<p class="main-features__title">Выгодная цена</p>
				</div>
				<p class="main-features__text">Обратившись к официальному дилеру ISUZU, Вы сможете приобрести качественную технику «ИСУЗУ» по выгодной цене. В наличии имеются как новые авто ISUZU, так и грузовики с пробегом.</p>
			</div>

			<div class="main-features__item">
				<div class="main-features__caption">
					<?= ImageHelper::show_svg('main-shipped', 'main-features__icon icon-wide_selection') ?>
					<p class="main-features__title">Широкий выбор</p>
				</div>
				<p class="main-features__text">Для каждого найдётся свой ISUZU: В наличии пикапы в 6 комплектациях, мало- и среднетоннажная линейки грузовых автомобилей, тяжёлые авто класса GIGA и большой выбор спецтехники.</p>
			</div>
		</div>
	</section>
	<div class="main-brand__img-block">

		<img src="/images/block_main_banner.jpg" alt="" class="main-brand__img">
		<div class="main-brand__content-head content-head__one">
			<div class="main-brand__title">
				<span class="main-brand__title-name">АВТОМОБИЛИ «ИСУЗУ»</span>
				<span class="main-brand__title-slogan">Бренд со столетней историей</span>
			</div>
			<p class="main-brand__subtitle">ЭТАЛОН НАДЁЖНОСТИ И КАЧЕСТВА</p>
		</div>
	</div>
	<section class="main-page__block main-page__block_brand">
		<div class="main-brand">
			<div class="main-page__content">
				<div class="main-brand__content">
					<div class="main-brand__content-head content-head__two">
						<div class="main-brand__title">
							<span class="main-brand__title-name">АВТОМОБИЛИ «ИСУЗУ»</span>
							<span class="main-brand__title-slogan">Бренд со столетней историей</span>
						</div>
						<p class="main-brand__subtitle">ЭТАЛОН НАДЁЖНОСТИ И КАЧЕСТВА</p>
					</div>
					<ul class="main-brand__ul">
						<li class="main-brand__li">
							<?= ImageHelper::show_svg('main-positive-vote', 'main-brand__li__icon') ?>
							<p class="main-brand__li__text">Положительные отзывы покупателей</p></li>
						<li class="main-brand__li">
							<?= ImageHelper::show_svg('main-medal', 'main-brand__li__icon') ?>
							<p class="main-brand__li__text">Отменная репутация</p></li>
						<li class="main-brand__li">
							<?= ImageHelper::show_svg('main-analyze', 'main-brand__li__icon') ?>
							<p class="main-brand__li__text">Внимание к каждой детали</p></li>
						<li class="main-brand__li">
							<?= ImageHelper::show_svg('main-russia', 'main-brand__li__icon-russia') ?>
							<p class="main-brand__li__text">Cолидный опыт работы на российском авторынке</p></li>
					</ul>
				</div>
				<div class="main-brand__slogan">
					<div class="main-brand__slogan-list">
						<div class="main-brand__slogan-item"><span class="main-brand__slogan-name">Автомобили ISUZU – </span><span class="main-brand__slogan-desc">выбор в пользу лучшего!</span></div>
						<div class="main-brand__slogan-item">Качество ISUZU не подвергается сомнениям, японские грузовики пользуются высоким спросом: кропотливая работа инженеров способствовала появлению надёжных, выносливых машин, способных бесперебойно выполнять любые транспортные задачи.</div>
						<div class="main-brand__slogan-item">Для российских автолюбителей техника ISUZU по умолчанию ассоциируется с качеством и солидностью, поскольку этим машинам по силам преодолеть любые трудности.</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

