<?php

use yii\db\Migration;

/**
 * Class m240301_071748_add_table_category_articles
 */
class m240301_071748_add_table_category_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_articles', [
            'id'               => $this->primaryKey(),
            'parent_id'        => $this->integer()->null()->comment('ID привязанной категории'),
            'name'             => $this->string()->notNull()->comment('Название'),
            'description'      => $this->text()->null()->comment('Описание'),
            'meta_name'        => $this->string()->null()->comment('Мета название'),
            'meta_description' => $this->string()->null()->comment('Мета описание'),
            'keywords'         => $this->string()->null()->comment('Ключевые слова (мета, теги)'),
            'visible'          => $this->tinyInteger()->defaultValue(true)->comment('Флаг видимости'),
            'create_at'        => $this->dateTime()->comment('Дата создания'),
            'update_at'        => $this->dateTime()->comment('Дата последнего изменения'),
        ]);


        $this->addCommentOnTable(
            'category_articles',
            'Таблица категорий для статей/новостей'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category_articles');
    }

}
