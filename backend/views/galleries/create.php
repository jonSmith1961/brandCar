<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Galleries */

$this->title = 'Создать галерею';
$this->params['breadcrumbs'][] = ['label' => 'Галереи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galleries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
	    'modelGalleries'  => $modelGalleries,
	    'modelsGalleryValue' =>  $modelsGalleryValue,
    ]) ?>

</div>
