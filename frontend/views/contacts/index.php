<?php

/**
 * @var \yii\web\View $this
 * @var \backend\models\City $city
 * @var \backend\models\DealerCenter $dealerCenters
 * @var array $itemsMapPoints
 * @var array $mapCenterPoint
 */


use backend\models\DealerCenter;
use common\helpers\CityHelper;
use phpnt\yandexMap\YandexMaps;

$this->title = 'Контактная информация';
/** @var DealerCenter $dealerCenter */
//$dealerCenter = CurrentCity::dealerCenters()[0]?>
<h1 class="center-red"><span>Контакты</span></h1>
<div class="contacts">
	<div class="contacts__content">
		<div class="contacts__title">ISUZU в России</div>
		<div class="contacts__list">
			<div class="contacts__item">
				<div class="contacts__item-ico">
					<svg class="contacts__item-icon">
						<use xlink:href="#icon-manufacture"></use>
					</svg>
				</div>
				<div class="contacts__item-text">
					<p><b>Завод ISUZU в Ульяновске</b></p>
					<p>г. Ульяновск ул. Азовская 97А</p>
					<p><a href="tel:+74957837035">+7 (495) 783-70-35</a>, доб. 5100</p>
				</div>
			</div>
			<div class="contacts__item">
				<div class="contacts__item-ico">
					<svg class="contacts__item-icon">
						<use xlink:href="#icon-agency"></use>
					</svg>
				</div>
				<div class="contacts__item-text">
					<p><b>Головной офис ISUZU</b></p>
					<p>г. Москва ул. Тверская 16, стр. 1, оф. Б602</p>
					<p><a href="tel:+74957837035">+7 (495) 783-70-35</a></p>
					<p>Горячая линия для Клиентов «Isuzu Care»</p>
					<p><a href="tel:+78007707035">8 800 770 70 35</a></p>
					<p onclick="togg_not(14)" class="text-tab" href="javascript:void(0);">Показать e-mail:</p>
					<p id="not14" class="text-tab-link" style="display:none;">
						<a href="mailto:office@isuzutrucks.ru">office@isuzutrucks.ru</a>
					</p>
				</div>
			</div>
			<?php
			foreach ($dealerCenters as $key =>  $dealerCenter) {
				$showKeyId = 21 + $key;
				?>
				<div class="contacts__item">
					<div class="contacts__item-ico">
						<svg class="contacts__item-icon">
							<use xlink:href="#icon-agency"></use>
						</svg>
					</div>
					<div class="contacts__item-text">
						<p><b>Официальный дистрибьютор автомобилей марки ISUZU</b></p>
						<?php /** @var DealerCenter $dealerCenter */?>
						<p><?= $city->name ?? ''?> <?=$dealerCenter->address ?? ''?></p>
						<p><a href="tel:+<?=CityHelper::filterPhoneGetDigitOnly($dealerCenter->phone)?>"><?= $dealerCenter->phone ?? '' ?></a></p>
						<p>Горячая линия для Клиентов</p>
						<p><a href="tel:<?=CityHelper::filterPhoneGetDigitOnly($city->phone_support)?>"> <?= $city->phone_support ?? ''?></a></p>
						<p onclick="togg_not(<?= $showKeyId ?>)" class="text-tab" href="javascript:void(0);">Показать e-mail:</p>
						<p id="not<?= $showKeyId ?>" class="text-tab-link" style="display:none;">
							<a href="mailto:<?=$dealerCenter->email ?? ''?>"><?=$dealerCenter->email ?? ''?></a>
						</p>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<div>
			<?php
			if(!empty($itemsMapPoints) && !empty($mapCenterPoint)) {
				echo YandexMaps::widget([
					'myPlacemarks' => $itemsMapPoints,
					'mapOptions' => [
						'center' => $mapCenterPoint,                                                // центр карты
						'zoom' => 16,                                                       // показывать в масштабе
						'controls' => ['zoomControl', 'fullscreenControl', 'searchControl'],  // использовать эл. управления
						'control' => [
							'zoomControl' => [                                                        // расположение кнопок управлением масштабом
								'top' => 0,
								'left' => 0
							],
						],
					],
					'disableScroll' => true,                                                    // отключить скролл колесиком мыши (по умолчанию true)
					'windowWidth' => '100%',                                                  // длинна карты (по умолчанию 100%)
					'windowHeight' => '400px',                                                 // высота карты (по умолчанию 400px)
				]);
			}
			?>
		</div>
	</div>
</div>