<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Обо мне';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Сделал тестовый проект для Порт Транзит. Я Павел!</p>
    <p>Моя почта: <a href="mailto:pavel.konzeptual@gmail.com">pavel.konzeptual@gmail.com</a></p>
    <p>Моя телега: <a href="https://t.me/pavel_dev" target="_blank">@pavel_dev</a></p>
</div>
