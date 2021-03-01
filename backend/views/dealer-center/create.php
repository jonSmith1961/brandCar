<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DealerCenter */

$this->title = 'Создание Дилерского центра';
$this->params['breadcrumbs'][] = ['label' => 'Дилерские центры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealer-center-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
