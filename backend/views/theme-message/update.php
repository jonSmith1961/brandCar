<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ThemeMessage */

$this->title = 'Изменение темы сообщений: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Темы сообщений', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="theme-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
