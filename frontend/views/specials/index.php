<?php
/**
 * @var $this View
 *
 * @var \backend\models\Specials $specials
 * @var \backend\models\Pagination $pages
 */

use common\helpers\File;
use yii\data\Pagination;
use yii\widgets\LinkPager;

?>
<div class="special_actions2">
	<h1 class="center-red"><span>Акции</span></h1>
	<div class="news-list">
		<?php
		foreach ($specials as $special) {
			$urlRow = '/specials/'.$special->alias.'/';
			$urlImageRow = File::GetResizedImage($special->preview_picture, 456, 456);
			?>
			<p class="news-item" id="<?=$special->id?>">
				<small>
					<a href="<?=$urlRow?>" >
						<?=$urlImageRow?>
					</a>
					<?=$special->brief?>
				</small>
				<br />
			</p>
			<?php
		}
		?>
	</div>
	<?php
	echo LinkPager::widget([
		'pagination' => $pages,
		'options' => [
			'tag' => 'div',
			'class' => 'pagenavigation',
			'id' => 'pager-container',
		],
		'linkContainerOptions' => [
			'tag' => 'div',
				'class' => 'pagenavigation__item'
		],
		'prevPageLabel' => '',
		'nextPageLabel' => '',
		'registerLinkTags' => false,
//		'lastPageLabel' => false,
		'prevPageCssClass' => 'pagenavigation__prev',
		'nextPageCssClass' => 'pagenavigation__next',
		'linkOptions' => [
				'class' => 'pagenavigation__link'
		],

	]);
	?>
</div>

