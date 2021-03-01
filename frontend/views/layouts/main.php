<?php

/**
 * @var $this yii\web\View
 * @var string $content
 */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\helpers\ImageHelper;
use frontend\helpers\Menu;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$user = Yii::$app->user;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<?php $this->registerCsrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
if ($user->can('alert')) {
    echo Alert::widget();
}
?>
<div class="site-wrap">

	<div class="site-canvas">

		<!-- header site -->

			<!-- header menu -->
            <?php echo Menu::widget()?>
			<!-- END header menu -->


        <div class="content">

	        <?php if (!empty($this->params['breadcrumbs'])) { ?>
                <div class="breadcrumb-wrap mp-elem-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-left">

						        <?= Breadcrumbs::widget([
									'class' => 'breadcrumb-navigation',
							        'links' => $this->params['breadcrumbs'] ?? [],
							        'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
						        ]) ?>

                            </div>
                        </div>
                    </div>
                </div>
	        <?php } ?>
			<div class="scroll-to-top">
				<xml version="1.0" encoding="iso-8859-1" ?="">
					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 240.835 240.835" style="enable-background:new 0 0 240.835 240.835;" xml:space="preserve">
                      <path id="Expand_Less" d="M129.007,57.819c-4.68-4.68-12.499-4.68-17.191,0L3.555,165.803c-4.74,4.74-4.74,12.427,0,17.155
              c4.74,4.74,12.439,4.74,17.179,0l99.683-99.406l99.671,99.418c4.752,4.74,12.439,4.74,17.191,0c4.74-4.74,4.74-12.427,0-17.155
              L129.007,57.819z"></path>
						<g>
						</g></svg>
				</xml>
			</div>
            <?= $content ?>

        </div>

		<?= $this->render('footer.php');?>

	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
