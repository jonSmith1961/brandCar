<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 13.07.2020
 * Time: 9:05
 */

/**
 * @var $this yii\web\View
 * @var array $menuItems
 * @var array $models
 * @var \backend\models\City $currentCity
 */

use common\helpers\CityHelper;
use common\helpers\UriHelper;
use yii\helpers\Html;

?>

<p class="header__phone header-phone__mob"><span>Служба клиентской поддержки ISUZU CARE: </span><a href="tel:88007707035"> 8 800 770 70 35</a></p>


<div class="header__container wrapper  header-container__wrapper">
	<div class="header-links__wrapper">
		<div class="header-links__item header-links__phone">
			<a href="tel:+<?=CityHelper::filterPhoneGetDigitOnly($currentCity->phone) ?? ''?>"><?= $currentCity->phone ?? '' ?></a>
			<p class="header__phone header-phone__desk"><span>Служба клиентской поддержки ISUZU CARE: </span>
				<a href="tel:<?=CityHelper::filterPhoneGetDigitOnly($currentCity->phone_support) ?? ''?>"> <?= $currentCity->phone_support ?? ''?></a>
			</p>
		</div>
		<ul class="header-links__list">
			<?php
			foreach ($menuItems as $menuItem) {
				$liActive = $menuItem['url'] === UriHelper::getCleanUrl() ? 'active' : '';
				$liClass = 'header-links__item'.' '.$liActive;
				echo Html::tag('li', Html::a($menuItem['label'], $menuItem['url'], $menuItem['options'] ?? []), ['class' => $liClass]);
			}
			?>
		</ul>
	</div>
</div>
<div class="header-menu">
	<div class="wrapper">
		<div class="header-main__wrapper">
			<div class="header__logo logo">
				<div class="logo__wrap">
					<div class="logo-link__box">
						<a href="/"><img class="logo__img" src="/images/svg/compony-logo.svg" alt="АГАТ"></a>
					</div>
					<p class="logo__description">Официальный дистрибьютор автомобилей марки ISUZU</p>
				</div>
			</div>
			<ul class="dropdown-menu">
				<li class="dropdown__item"  >
					<a href="javascript:void(0);">Модельный ряд</a>
					<div class="dropdown-wrapper">
						<ul class="dropdown">
							<?php

							foreach ($models as $model) {
								?>

								<li>
									<a class="dropdown-item__link" href="/models/<?=$model->code?>/"><?=$model->menu_name?></a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</li>
				<li class="dropdown__item"  >
					<a href="/specials/">Акции</a>
				</li>
				<li class="dropdown__item"  >
					<a href="javascript:void(0);">О компании</a>
					<div class="dropdown-wrapper">
						<ul class="dropdown">
							<li>
								<a class="dropdown-item__link" href="/about/">О компании</a>
							</li>
							<li>
								<a class="dropdown-item__link" href="/news/">Новости</a>
							</li>
							<li>
								<a class="dropdown-item__link" href="/policy/">Политика конфиденциальности</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>
			<!------------ mobile ------------>
			<div class="mobile-menu">
				<div class="mob-model-wrap mob-main-menu__item">
					<p class="mob-opener">
						МОДЕЛЬНЫЙ РЯД
					</p>
					<div class="mob-menu__wrapper">
						<ul class="mob-model-list">
							<?php
							foreach ($models as $model) {
								?>
								<li class="dropdown-models__item">
									<a class="dropdown-models__link" href="/models/<?=$model->code?>/"><?=$model->menu_name?></a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
				<div class="mob-menu-items-wrap mob-main-menu__item">
					<p class="mob-opener">
						<img src="/images/icons/burger.png" alt="menu-icon">
						МЕНЮ
					</p>
					<div class="mob-menu__wrapper">
						<ul class="mob-menu-list">
							<li class="mob-menu__item"  >
								<ul class="mob-dropdown-list ">
									<li class="mob-menu__item">
										<a class="mob-dropdown__link" href="/specials/">Акции</a>
									</li>
								</ul>
							</li>
							<li class="mob-menu__item"  >
								<ul class="mob-dropdown-list ">
									<li class="mob-menu__item">
										<a class="mob-dropdown__link" href="/news/">Новости</a>
									</li>
									<li class="mob-menu__item">
										<a class="mob-dropdown__link" href="/contacts/">Контакты</a>
									</li>
								</ul>
							</li>
							<li class="mob-menu__item">
								<a class="mob-dropdown__link" href="/about/">О компании</a>
							</li>
							<li class="mob-menu__item"  >
								<a class="mob-dropdown__opener" href="javascript:void(0);">Контакты</a>
								<ul class="mob-dropdown-list ">
									<li class="mob-menu__item">
										<a class="mob-dropdown__link" href="/contacts/">Контакты</a>
									</li>
									<li class="mob-menu__item">
										<a class="mob-dropdown__link" href="/contacts/feedback/">Обратная связь</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
