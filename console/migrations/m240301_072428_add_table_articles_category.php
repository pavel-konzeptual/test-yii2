<?php

use yii\db\Migration;

/**
 * Class m240301_072428_add_table_articles_category
 */
class m240301_072428_add_table_articles_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles_category', [
            'id'               => $this->primaryKey(),
            'article_id'       => $this->integer()->notNull()->comment('ID статьи/новости'),
            'category_id'      => $this->integer()->notNull()->comment('ID привязанной категории'),
            'create_at'        => $this->dateTime()->comment('Дата создания'),
            'update_at'        => $this->dateTime()->comment('Дата последнего изменения'),
        ]);

        $this->createIndex(
            'articles_category_cat_id',
            'articles_category',
            'category_id');


        $this->addCommentOnTable(
            'articles_category',
            'Таблица привязанных категорий для статей/новостей'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles_category');
    }
}
