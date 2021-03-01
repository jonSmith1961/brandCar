<?php

/**
 * @var View $this
 * @var \backend\models\GalleryValue $mainPageTopGalleryValues
 */


use common\helpers\File;
use frontend\helpers\ImageHelper;

if(!empty($mainPageTopGalleryValues)){
	?>
	<section class="main-slider">
		<div class="swiper-container gallery-top">
			<div class="swiper-wrapper">

				<?php
				foreach ($mainPageTopGalleryValues as $item) {

					/** @var backend\models\GalleryValue $item */
					$imagePath = $specificationsFile =  File::getPath($item->file_id);
					$image_prev =  File::GetResizedImage($item->file_id, 1920, 700);

					$urlRow = (!empty($item->url)) ? $item->url : 'javascript:void(0);';
					?>
					<div class="swiper-slide">
						<a href="<?= $urlRow?>">
							<?= $image_prev ?? ''?>
						</a>
					</div>
					<?php
				}
				?>
			</div>
			<div class="swiper-button-next main-slider-button-next">
				<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
			</div>
			<div class="swiper-button-prev main-slider-button-prev">
				<?= ImageHelper::show_svg('icon-arrow', 'icon icon-arrow') ?>
			</div>
			<div class="swiper-pagination main-slider-swiper-pagination">
			</div>
		</div>
		<div class="main-slider__nav-wrapper-thumbs">
			<div class="main-slider__nav-thumbs">
				<div class="swiper-container gallery-thumbs main-slider__gallery-thumbs">
					<div class="swiper-wrapper main-slider__gallery-thumbs-wrapper">
						<?php
						foreach ($mainPageTopGalleryValues as $key => $item) {
							$keyRow = $key + 1;
							/** @var backend\models\GalleryValue $item */
							?>
							<div class="swiper-slide">
								<span class="main-slider__name"><?= $item->name?></span>
								<span class="main-slider__num"><?=$keyRow?></span>
							</div>

							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="main-slider__nav-wrapper" >
			<div class="main-slider__nav">
				<div class="main-slider__nav-block">
					<p class="main-slider__number">01</p>
					<svg class="main-slider__icon-arrow icon-arrow">
						<use xlink:href="#icon-arrow"></use>
					</svg>
				</div>
			</div>
		</div>
	</section>
	<?php
}
?>

