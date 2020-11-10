<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php if (Yii::$app->user->isGuest) : ?>
    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">Для доступа к контактам, пожалуйста, войдите на сайт.</p>
        <p class="lead">Если же вы на сайте впервые, пожалуйста, зарегистрируйтесь.</p>
    </div>
    <?php endif; ?>

</div>
