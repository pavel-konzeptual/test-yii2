<?php 
    $this->title = 'Новости автора: ' . $author['first_name'];
?>
<h1>Новости автора: <?= $author['first_name']; ?></h1>
<div class="biography mb-3">
    <?= $author['biography']; ?>
</div>
<?php foreach($articles as $article): ?>
    <div class="col-md-4 col-xs-12 mb-4">
        <div class="item_block shadow-sm rounded" style="border: 1px solid #BBB;padding:7px;">
            <div class="item_name mb-2"><a href="/articles/<?= $article->alias; ?>"><?= $article->name; ?></a> <?php if (!Yii::$app->user->isGuest): ?><small>(<a href="/articles/update/<?= $article->id; ?>">изменить</a>)</small><?php endif; ?></div>
            <div class="item_image text-center mb-2"><img src="/<?= $article->image; ?>" class="img-fluid rounded" alt="<?= $article->name; ?>"></div>
            <div class="item_announce"><?= $article->announce; ?></div>
            <div class="item_author"><br>Автор: <a href="/articles-author/<?= $article->author_id ?>" class="author_link"><?= $article->author->first_name; ?></a></div>
        </div>
    </div>
<?php endforeach; ?>