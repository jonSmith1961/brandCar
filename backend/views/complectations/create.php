<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Complectations */

$this->title = 'Создать комплектацию';
$this->params['breadcrumbs'][] = ['label' => 'Комплектации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
