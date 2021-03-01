<?php
/**
 * @var $this View
 *
 * @var \backend\models\News $newsAll
 * @var \backend\models\Pagination $pages
 */

use common\helpers\File;
use yii\data\Pagination;
use yii\widgets\LinkPager;

?>
<div class="wrapper">
	<div class="news_actions2">
		<h1 class="center-red"><span>Новости</span></h1>
		<div class="news-list">
			<?php
			foreach ($newsAll as $news) {

				/** @var \backend\models\News $news */
				$urlRow = '/news/'.$news->alias.'/';

				$dateRow = $news->active_from ? date("m.d.Y", $news->active_from) : '';
				$urlImageRow = File::GetResizedImage($news->preview_picture, 456, 376, [
						'alt' => $news->title,
				]);
				?>
				<div class="news-list__item news-item" id="<?=$news->id?>">
					<div class="news-list__image">
							<a href="<?=$urlRow?>">
								<?=$urlImageRow?>
							</a>
						<p class="news-list__date"><?= $dateRow?></p>

					</div>
					<a href="<?=$urlRow?>" class="news-list__title" >
						<?=$news->brief?>
					</a>
				</div>
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
			'registerLinkTags' => true,
	//		'lastPageLabel' => false,
			'prevPageCssClass' => 'pagenavigation__prev',
			'nextPageCssClass' => 'pagenavigation__next',
			'linkOptions' => [
				'class' => 'pagenavigation__link'
			],

		]);
		?>
	</div>
</div>

