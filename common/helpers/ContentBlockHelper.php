<?php


namespace common\helpers;


use backend\models\ContentBlock;

class ContentBlockHelper
{

	/**
	 * @param $code
	 */
	public static function ShowContentBlock($code)
	{
		$content_block = ContentBlock::findOne(['code' => $code]);
		if ($content_block) {
			echo htmlspecialchars_decode($content_block->content);
		}
	}

	/**
	 * @param $code
	 */
	public static function ShowContentBlocksByCity($code)
	{
		$content_block_exist = ContentBlock::findOne(['code' => $code]);
		$content_blocks = [];

		if ($content_block_exist) {
			$content_blocks = ContentBlock::find()->where([ContentBlock::tableName().'.code' => $code])->activeAndCurrentCity()->all();
		}
		if ($content_blocks) {
			foreach ($content_blocks as $content_block ) {
//				$content = self::TagsReplaces($content_block->content);
				$content = $content_block->content;
				echo htmlspecialchars_decode($content);
			}
		}
	}

	public static function TagsReplaces($content){
		$currentCityId = CITY_ID;

		$configTags =[
			1 => '+7 (8512) 48-28-28',
			2 => '+7 (8652) 99-70-00',
		];

		$hashTags = ['#PHONE_CITY#'];
		$valuesTags   = [];

		if(isset($configTags[$currentCityId])){
			$valuesTags   = array($configTags[$currentCityId]);
		}

		$output  = str_replace($hashTags, $valuesTags, $content);

		return $output;
	}

	public static function ShowYandexMap($size, $cityName, $placeMarks, $icon = null)// требуется подключение <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU'"></script>
	{
		$DivID = 'YMapID_' . rand(1000000, 9999999);
		ob_start();
		$placeMarkParams = $icon ? "{
                                            iconLayout: 'default#image',
                                            iconImageHref: '" . $icon. "',
                                            iconImageSize: [30, 42],
                                            iconImageOffset: [-15, -42]
                                        }" : "{}" ?>
		<div id="<?= $DivID ?>" style="width: <?= $size['width'] ?>;height: <?= $size['height'] ?>px;"></div>
		<script>
			wait_load();

			function wait_load() {
				if (typeof ymaps !== 'undefined' && typeof ymaps.geocode === 'function') {
					console.log('init');
					init();
				} else {
					setTimeout(function () {
						wait_load();
					}, 200);
				}
			}

			function init() {
				var myMap,
					cityCenter, mapZoom = 11, mapCenter = {
						minX: 0,
						maxX: 0,
						minY: 0,
						maxY: 0
					};
				ymaps.ready(function () {
					ymaps.geocode("<?=$cityName?>").then(
						function (res) {
							cityCenter = res.geoObjects.get(0).geometry.getCoordinates();
							myMap = new ymaps.Map("<?= $DivID?>", {
								center: cityCenter,
								zoom: mapZoom
							});
							<?php foreach ($placeMarks as $placemark) {
							$rnd = rand(1000000, 9999999);?>
							ymaps.geocode("<?=$cityName?>, <?=$placemark['address']?>").then(
								function (res<?= $rnd?>) {
									var coords = res<?= $rnd?>.geoObjects.get(0).geometry.getCoordinates();
									if (mapCenter.minX == 0 || mapCenter.minX > coords[0]) {
										mapCenter.minX = coords[0];
									}
									if (mapCenter.maxX == 0 || mapCenter.maxX < coords[0]) {
										mapCenter.maxX = coords[0];
									}
									if (mapCenter.minY == 0 || mapCenter.minY > coords[1]) {
										mapCenter.minY = coords[1];
									}
									if (mapCenter.maxY == 0 || mapCenter.maxY < coords[1]) {
										mapCenter.maxY = coords[1];
									}
									var myPlacemark = new ymaps.Placemark(
										coords, {
											balloonContent: "<div style='padding: 13px 35px 0 10px;'><?= ($placemark['hint'] ?? $placemark['address'])?></div>"
										}, <?= $placeMarkParams ?>
									);
									myMap.geoObjects.add(myPlacemark);
									myMap.setCenter([(mapCenter.minX + mapCenter.maxX) / 2, (mapCenter.minY + mapCenter.maxY) / 2]);
								}
							);
							<?php } ?>
						},
						function (err) {
							console.log(err);
						}
					);
				});
			}
		</script>
		<?= ob_get_clean();
	}

}