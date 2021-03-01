<?php
/**
 * Created by PhpStorm.
 * User: al.filippov
 * Date: 16.05.2019
 * Time: 16:33
 */

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model common\models\User
 * @var array $groups
 */

$this->title = 'Создать пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">

            <?= $this->render('_form', [
                'model' => $model,
                'groups' => $groups,
            ]) ?>

        </div>
    </div>

</div>