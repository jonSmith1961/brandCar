<?php

/**
 * @var View $this
 * @var \backend\models\News $mainPageNews
 */

use common\helpers\File;

?>
<div class="main-news__list">

	<?php
	if(!empty($mainPageNews)){
		foreach ($mainPageNews as $mainPageNew) {

			/** @var backend\models\News $mainPageNew */
			$imagePath = $specificationsFile =  File::getPath($mainPageNew->preview_picture);
			$image_prev =  File::GetResizedImage($mainPageNew->preview_picture, 1920, 700);

			$urlRow = $mainPageNew->alias ? '/news/'.$mainPageNew->alias.'/' : '';
			$dateRow = $mainPageNew->active_from ? File::rdate("d M Y", $mainPageNew->active_from) : '';

			?>
			<div class="main-news__item" style="background-image: url('<?= $imagePath ?? ''?>');">

				<div class="main-news__footer">
					<a href="<?= $urlRow ?>" class="main-news__title"><?= $mainPageNew->title ?? ''?></a>
					<p class="main-news__date"><?= $dateRow?></p>

				</div>
			</div>
			<?php
		}
	}
	?>
</div>

<a href="/news/" class="main-page__more">Больше новостей +</a>
