<?php

use backend\models\City;
use common\helpers\CF;
use frontend\helpers\ImageHelper;

$currentCity = City::getCurrentCity();

if(!empty($currentCity->social)){
	$currentCitySocials = CF::stdClassDecode($currentCity->social);
}

usort($currentCitySocials, function ($a, $b){
	if ($a['socials_sort'] > $b['socials_sort']) return 1;
});

$test = 54;
?>


<div class="footer__social">
	<div class="social-footer">
		<p class="footer__textarea"></p>
		<ul class="social-footer__list">
			<?php
			foreach ($currentCitySocials as $currentCitySocial) {
				?>
				<li class="social-footer__item">
					<a href="<?=$currentCitySocial['socials_url'] ?? ''?>" class="social-footer__link">
						<?php
						if(!empty($currentCitySocial['socials_code'])){
							echo ImageHelper::show_svg($currentCitySocial['socials_code'], 'social-footer__icon');
						}
						?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
</div>
