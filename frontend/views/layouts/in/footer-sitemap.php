<?php

use backend\models\Models;

$models = Models::find()->active()->orderBy(['sort' => SORT_ASC])->all();

?>
<div class="sitemap__content">
	<ul class="map-level-0 sitemap__list">
		<li class="sitemap__item"><a class="sitemap__link" href="/models/elf/"><span>Модельный ряд</span></a>
			<ul class="map-level-1 sitemap__sublist">
				<?php

				foreach ($models as $model) {
					?>
					<li class="sitemap__subitem">
						<a class="sitemap__sublink" href="/models/<?=$model->code?>/"><?=$model->menu_name?></a>
					</li>
					<?php
				}
				?>
			</ul>
		</li>
		<li class="sitemap__item"><a class="sitemap__link" href="/specials/"><span>Акции</span></a></li>
		<li class="sitemap__item"><a class="sitemap__link" href="/contacts/"><span>Контакты</span></a>
			<ul class="map-level-1 sitemap__sublist">
				<li class="sitemap__subitem"><a class="sitemap__sublink" href="/contacts">Контакты</a></li>
				<li class="sitemap__subitem"><a class="sitemap__sublink" href="/contacts/feedback/">Обратная связь</a></li>
			</ul>
		</li>
		<li class="sitemap__item"><a class="sitemap__link" href="/company/about/"><span>О компании</span></a>
			<ul class="map-level-1 sitemap__sublist">
				<li class="sitemap__subitem"><a class="sitemap__sublink" href="/news/">Новости</a></li>
				<li class="sitemap__subitem"><a class="sitemap__sublink" href="/company/feedback/">Обратная связь</a></li>
				<li class="sitemap__subitem"><a class="sitemap__sublink" href="/policy/">Политика конфиденциальности</a></li>
			</ul>
		</li>
	</ul>
</div>
