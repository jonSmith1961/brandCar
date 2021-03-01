<?php

/* @var $this View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\helpers\AdminPanel;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap-admin">
    <?php
    NavBar::begin([
	    'brandLabel' => Yii::$app->name,
	    'brandUrl' => Yii::$app->homeUrl,
	    'options' => [
		    'class' => 'navbar-inverse navbar-fixed-top',
	    ],
    ]);
    if (!Yii::$app->user->isGuest) {
	    echo Nav::widget([
		    'options' => ['class' => 'navbar-nav navbar-right'],
		    'items' => AdminPanel::main_menu_items(),
	    ]);
    }
    NavBar::end();
    ?>

	<!--sidebar-menu-->
	<div id="sidebar">
		<?php if (!Yii::$app->user->isGuest) {
			$menu_items = AdminPanel::mainMenuItems() ?>
			<ul>
				<?php foreach ($menu_items as $menu_item) {
					$class = '';
					$is_parent = !empty($menu_item['items']);
					if ($is_parent) {
						$class = 'submenu';
					}
					if (!empty($menu_item['active'])) {
						$class .= ($is_parent ? ' open' : ' active');
					}?>
					<li class="<?= $class ?>">
						<a href="<?= (isset($menu_item['url']) ? Url::toRoute($menu_item['url']) : '') ?>"
						   tabindex="-1">
							<span><?= $menu_item['label'] ?></span>
							<?php if ($is_parent) { ?>
								<i class="icon icon-chevron-down"></i>
							<?php } ?>
						</a>
						<?php if ($is_parent) { ?>
							<ul>
								<?php foreach ($menu_item['items'] as $item) {
									$class = '';
									$is_parent_lvl2 = !empty($item['items']);
									if ($is_parent_lvl2) {
										$class = 'submenu__lvl2';
									}
									if (!empty($item['active'])) {
										$class .= ' active';
									}?>
									<li class="<?= $class ?>">
										<a href="<?= Url::toRoute($item['url']) ?>" tabindex="-1">
											<span><?= $item['label'] ?></span>
											<?php if ($is_parent_lvl2) { ?>
												<i class="icon icon-chevron-down"></i>
											<?php } ?>
										</a>
										<?php if ($is_parent_lvl2) { ?>
											<ul>
												<?php foreach ($item['items'] as $sub_item) { ?>
													<li>
														<a href="<?= Url::toRoute($sub_item['url']) ?>">
															<?= $sub_item['label'] ?>
														</a>
													</li>
												<?php } ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						<?php } ?>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
	<!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= Alert::widget() ?>
            <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div> -->
        </div>
        <!--End-breadcrumbs-->
        <div class="container-fluid">
			<?= $content ?>

        </div>
        <!--end-main-container-part-->
    </div>


</div>
<!--Footer-part-->
<div class="row-fluid">
    <footer class="footer" id="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->name ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
</div>
<!--end-Footer-part-->
<div class="wrap">
    <div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
        <!-- <?= $content ?> -->
    </div>
</div>
<span class="scroll_top"><svg class="svg-inline--fa fa-chevron-up fa-w-14" aria-hidden="true" data-prefix="fas" data-icon="chevron-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path></svg><!-- <i class="fas fa-chevron-up"></i> --></span>
<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= Html::encode(Yii::$app->name) ?> &copy; <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
