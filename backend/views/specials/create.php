<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Specials */

$this->title = 'Создание акции';
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
