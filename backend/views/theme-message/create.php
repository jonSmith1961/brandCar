<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ThemeMessage */

$this->title = 'Создать Тему сообщения';
$this->params['breadcrumbs'][] = ['label' => 'Темы сообщений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="theme-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
