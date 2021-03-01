<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipient */

$this->title = 'Изменение группы получателей ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Получатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="recipient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
