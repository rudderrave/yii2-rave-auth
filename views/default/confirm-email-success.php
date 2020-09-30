<?php

/**
 * @var yii\web\View $this
 * @var ravesoft\models\User $user
 */

$this->title = Yii::t('rave/auth', 'E-mail confirmed');
?>
<div class="change-own-password-success">

    <div class="alert alert-success text-center">
        <?= Yii::t('rave/auth', 'E-mail confirmed') ?> - <b><?= $user->email ?></b>
    </div>

</div>
