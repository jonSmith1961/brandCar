<?php


/**
 * @var View $this
 * @var \backend\models\Specials $mainPageSpecials
 */

use common\helpers\File;
use frontend\helpers\ImageHelper;


if(!empty($mainPageSpecials)){
	?>
	<div class="main-actions">
		<div class="swiper-container main-actions-container">
			<div class="swiper-scrollbar main-actions-scrollbar"></div>
			<div class="swiper-wrapper">
				<?php
				foreach ($mainPageSpecials as $item) {

					/** @var backend\models\Specials $item */
					$imagePath = $specificationsFile =  File::getPath($item->preview_picture);
					$image_prev =  File::GetResizedImage($item->preview_picture, 1920, 700);

					$urlRow = $item->url ? $item->url : '/specials/'.$item->alias.'/';
					?>
					<a class="swiper-slide main-actions-swiper-slide" href="<?= $urlRow?>" >
						<?= $image_prev ?? ''?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
		<div class="swiper-button-next main-actions-button-next">
			<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
		</div>
		<div class="swiper-button-prev main-actions-button-prev">
			<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
		</div>
	</div>

	<a href="/specials/" class="main-page__more main-page__more_white">Все акции</a>
	<?php
}