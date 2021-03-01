<?php
/**
 * @var $this View
 *
 * @var \backend\models\Specials $special
 */

use common\helpers\File;


?>
<style>
	p {
		/* font-family: 'Arial', sans-serif; */
		font-size: 16px;
		color: #000;
		margin: 10px 0px;
		line-height: 22px;
	}
</style>
<div class="wrapper">
	<div class="action_detail">
		<div class="news-detail">
			<h1 class="news-detail__title content__title"><span><?= $special->title?></span></h1>
			<?= File::GetResizedImage($special->detail_picture, 1920, 700);?>
			<div class="service-contract__container">
				<p class="service-contract__title"><b><?= $special->sub_title?></b></p>
				<?= $special->text?>
			</div>
		</div>
	</div>
</div>