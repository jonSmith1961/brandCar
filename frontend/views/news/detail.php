<?php
/**
 * @var $this View
 *
 * @var \backend\models\News $news
 */

use common\helpers\File;

$this->registerCssFile('/css/slick.css');
$this->registerCssFile('/css/magnific-popup.css');
$this->registerCssFile('/css/font-awesome-css.min.css');

$this->registerJsFile('/js/slick.min.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);
$this->registerJsFile('/js/fa02.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);
$this->registerJsFile('/js/magnific-popup.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);
$this->registerJsFile('/js/slick-slider-init.js', [
	'depends' => \yii\web\JqueryAsset::class,
	'position' => yii\web\View::POS_END
]);

?>
<div class="wrapper">
	<div class="news-detail">
		<h1 class="news-detail__title content__title"><span><?= $news->title ?? ''?></span></h1>
		<div class="news-detail__wrap">
			<div class="news-detail__content">
				<div class="news-detail__text content__text">
					<?= $news->text ?? ''?>
				</div>
			</div>
			<?php
			if(!empty($news->gallery1_id)){
				$newsGallery1 = $news->gallery1Value;
				?>
				<h2 class="news-detail__subtitle content__title content__title_h2">Фотографии</h2>
				<div class="news-detail__photos news-slider news-detail__popup-gallery ">
						<?php
						foreach ($newsGallery1 as $item) {

							$imagePath = $specificationsFile =  File::getPath($item->file_id);
							$image_prev =  File::GetResizedImage($item->file_id, 650, 450);
							?>
							<a class="news-detail__photo slick-slide" href="<?=$imagePath ?? ''?>">
								<?= $image_prev ?? ''?>
							</a>
							<?php
						}
						?>


				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
