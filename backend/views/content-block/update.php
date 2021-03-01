<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentBlock */
/* @var $versions backend\models\ContentBlockVersions */

$this->title = 'Изменение контент блока: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контент блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="content-block-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<section class="panel panel-default widget-update">
		<div class="panel-heading"><?= Html::encode($this->title) ?></div>
		<div class="panel-body">
			<div class="well">
				<h4>Код для вставки</h4>
				<pre class="mt-code"><?= Html::encode('<?php ContentBlockHelper::ShowContentBlocksByCity(\'' . $model->code . '\') ?>') ?></pre>
			</div>
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
			<?php
			if(!empty($versions)){
				?>
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-green">Сохраненные версии</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-light table-hover">
								<?php foreach ($versions as $version) {?>
								<tr>
									<td><?= Yii::$app->formatter->asDatetime($version->created_at) ?></td>
									<td width="10%"><?= Html::a('Восстановить', Url::toRoute(['/content-block/recover/', 'id' => $version->id]), ['data-confirm' => 'Вы уверены, что хотите заменить текущую версию?']) ?></td>
									<td width="10%"><?= Html::a('Посмотреть', Url::to(['/site/content-block-version/', 'id' => $version->id]), ['class' => 'fancybox_ajax']) ?></td>
									<?php }?>
							</table>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</section>

</div>
