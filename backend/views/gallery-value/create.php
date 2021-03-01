<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleryValue */

$this->title = 'Создать Gallery Value';
$this->params['breadcrumbs'][] = ['label' => 'Gallery Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
