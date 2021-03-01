<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Complectations */

$this->title = 'Изменение комплектации: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Комплектации', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="complectations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
