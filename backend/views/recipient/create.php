<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipient */

$this->title = 'Создать группу получателей';
$this->params['breadcrumbs'][] = ['label' => 'Получатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
