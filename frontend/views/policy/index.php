<?php

/**
 * @var \yii\web\View $this
 */
use common\helpers\ContentBlockHelper;

$this->title = 'Политика конфиденциальности';
?>
<style>
	p {
		/* font-family: 'Arial', sans-serif; */
		font-size: 16px;
		color: #000;
		margin: 10px 0px;
		line-height: 22px;
	}
	.policy_list li {
		font-family: 'Arial',sans-serif;
		font-size: 15px;
		color: #000;
		margin: 10px 0px;
		line-height: 22px;
		margin-left: 45px;
	}
</style>

<div class="wrapper">


	<div class=" center">
		<h1 class="center-red"><span>ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ</span> </h1>
		<?php ContentBlockHelper::ShowContentBlocksByCity('page-content-policy-nn') ?>
	</div>


</div>