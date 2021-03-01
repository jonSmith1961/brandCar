<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Models */

$this->title = 'Создать модель';
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
