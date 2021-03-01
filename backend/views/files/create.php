<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Files */

$this->title = 'Создать файл';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
