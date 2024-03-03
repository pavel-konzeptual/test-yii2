<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use \yii\helpers\Url;
AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="sticky-top">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index'], 'options' => ['id' => 'homePage']],
        ['label' => 'Обо мне', 'url' => ['/site/about'], 'options' => ['id' => 'aboutPage']],
        ['label' => 'Статьи', 'url' => ['/articles/index'], 'options' => ['id' => 'articlesPage']],
        /*['label' => 'Контакты', 'url' => ['/site/contact'], 'options' => ['id' => 'contactPage']],*/
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
    }

    $menuItems[] = ['label' => 'Добавить статью', 'url' => ['/articles/add'], 'options' => ['id' => 'articlesAdd']];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', Html::a('Вход',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
    <div class="clearfix" style="position:relative;">
        <div class="col-sm-2 search_block">
            <form method="get" action="<?= Url::to(['articles/search']); ?>" class="pull-right">
                <div class="input-group">
                    <input type="text" name="query" id="searchInput" class="form-control" placeholder="Поиск по статьям">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" id="searchBtn" type="submit">
                            Найти
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>

        <?php if (Url::current() == '/index.php?r=site%2Findex' || Url::current() == Url::home() && Yii::$app->user->isGuest): ?>
            <div class="bg-primary text-white p-2 mb-4" >
                Логин для входа: <b>admin</b>
                <br>
                Пароль: <b>12345</b>
            </div>
        <?php endif; ?>

        <div id="mainContent" class="row">
            <?= $content ?>
        </div>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end">Created by Pavel.MonRo</p>
    </div>
</footer>

<?php $this->endBody() ?>

<div class="modal" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalTitle">User Modal</h5>
        <div class="float-end">
            <button type="button" class="close btn btn-primary" id="closeUserModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
      </div>
      <div class="modal-body" id="userModalBody">
            &nbsp;
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closeUserModalBtn" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#closeUserModal, #closeUserModalBtn').click(function() {
    $('#userModal').modal('toggle');
});

$('#searchBtn').click(function(e) {
    e.preventDefault();
    goSearch();
});

$(document).on('keypress',function(e) {
    if(e.which == 13) {
        goSearch();
    }
});

$(document).on('keydown keyup', '#searchInput', function () {
    var query = $(this).val();

    if (query.length >= 2) {
        goSearch();
    }
});

function goSearch () {
    var query = $('#searchInput').val();

    $.getJSON('articles/search?query=' + query, function(data) {
        $('#mainContent').empty();

        if (!data.articles.length) {
            $('#mainContent').html('<div class="alert alert-info">Ничего не найдено</div>');
        }

        $.each(data.articles, function(index, item) {
            var itemImage = item.image;
            var newsItem = '<div class="col-md-4 col-xs-12 mb-4"><div class="item_block" style="border: 1px solid #BBB;border-radius:3px;padding:3px;">';
            newsItem += '<div class="item_name mb-2"><a href="/articles/'+item.alias+'">'+ item.name +'</a> <?php if (!Yii::$app->user->isGuest): ?><small>(<a href="/articles/update/'+item.id+'">изменить</a>)</small><?php endif; ?></div>';
            if (itemImage) {
                newsItem += '<div class="item_image mb-2"><img src="'+item.image+'" class="img-fluid" alt="'+item.name+'"></div>';
            }
            newsItem += '<div class="item_announce">'+ item.announce +'</div>';
            newsItem += '<div class="item_author"><br>Автор: <a href="/articles-author/'+item.author_id+'" class="author_link">'+ item.author.first_name +'</a></div>';
            newsItem += '</div></div>';

            $('#mainContent').append(newsItem);
        });
    });
}
</script>

<style>
    .search_block {
        position: absolute;
        z-index: 10000;
        top: 8px;
        right: 25%;
    }
</style>
</body>
</html>
<?php $this->endPage();
