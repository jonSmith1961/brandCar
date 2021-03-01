<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DealerCenter */

$this->title = 'Изменение Дилерского центра: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Дилерские центры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="dealer-center-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
