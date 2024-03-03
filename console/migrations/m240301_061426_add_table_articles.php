<?php

use yii\db\Migration;

/**
 * Class m240301_061426_add_table_articles
 */
class m240301_061426_add_table_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull()->comment('Название'),
            'alias'          => $this->string()->notNull()->comment('Алиас'),
            'image'          => $this->string()->comment('Изображение'),
            'announce'       => $this->string()->notNull()->comment('Анонс'),
            'description'    => $this->text()->comment('Полное описание'),
            'author_id'      => $this->integer(11)->comment('ID автора'),
            'create_user_id' => $this->integer(11)->comment('Автор'),
            'update_user_id' => $this->integer(11)->comment('Автор последнего изменения'),
            'visible'        => $this->tinyInteger()->defaultValue(true)->comment('Флаг видимости'),
            'create_at'      => $this->dateTime()->comment('Дата создания'),
            'update_at'      => $this->dateTime()->comment('Дата последнего изменения'),
        ]);

        $this->createIndex(
            'articles_author_id',
            'articles',
            'author_id');

        $this->createIndex(
            'articles_create_user_id',
            'articles',
            'create_user_id');
        
        $this->createIndex(
            'articles_update_user_id',
            'articles',
            'update_user_id');

        $this->addCommentOnTable(
            'articles',
            'Таблица статей/новостей'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');
    }
}
