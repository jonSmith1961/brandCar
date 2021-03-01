<?php

/**
 * @var View $this
 * @var \backend\models\Models $models
 */

use common\helpers\File;

?>
<div class="main-models__list">
	<?php
	if(!empty($models)){
		foreach ($models as $keyRow => $model) {
			if($keyRow === 0){
				?>
				<div class="main-models__row main-models__row_first">
				<?php
			}
			?>
			<div class="main-models__item">
				<a href="/models/<?=$model->code?>/">
					<?= File::GetResizedImage($model->preview_picture, 338, 165,
						[
							'class'=>"main-models__img",
						]);?>
					<div class="main-models__title" target="_blank"><?=$model->menu_name?></div></a>
			</div>
			<?php
			if (($keyRow + 1) % 2 == 0 && ($keyRow + 1 ) != count($models)) {
				?>
				</div>
				<div class="main-models__row">
				<?php
			}
			?>

			<?php
			if (($keyRow + 1 ) == count($models)) {
				?>
				</div>
				<?php
			}
			?>
			<?php
		}
	}
	?>
</div>
