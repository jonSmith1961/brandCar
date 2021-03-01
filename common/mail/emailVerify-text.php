<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Здравствуйте <?= $user->username ?>,

Перейдите по ссылке ниже, чтобы подтвердить свою электронную почту:

<?= $verifyLink ?>
