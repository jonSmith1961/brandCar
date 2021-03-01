<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleryValue */

$this->title = 'Изменение Gallery Value: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Gallery Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="gallery-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
