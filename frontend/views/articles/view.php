<?php
$this->title = $model->name . ' - ' . Yii::$app->name;
?>
<div class="col-md-12">

    <h1><?= $model->name; ?></h1>

    <?php if (!empty($model->image)): ?>
        <div class="news_image mb-3 mt-3 text-center">
            <img src="/<?= $model->image; ?>" class="img-fluid" style="max-width:80%" alt="<?= $model->name; ?>">
        </div>
    <?php endif; ?>

    <div class="news_description">
        <?= $model->description; ?>
    </div>

    <div class="news_meta float-end pt-3 pb-3">
    Автор: <?= $model->author->first_name; ?>
    </div>
</div>