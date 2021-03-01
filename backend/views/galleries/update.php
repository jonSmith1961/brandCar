<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelGalleries backend\models\Galleries */
/* @var $modelsGalleryValue backend\models\GalleryValue */

$this->title = 'Изменение галереи: ' . $modelGalleries->name;
$this->params['breadcrumbs'][] = ['label' => 'Галереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelGalleries->name, 'url' => ['view', 'id' => $modelGalleries->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="galleries-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'modelGalleries'  => $modelGalleries,
		'modelsGalleryValue' =>  $modelsGalleryValue,
	]) ?>

</div>
