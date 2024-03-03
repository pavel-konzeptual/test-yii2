<?php

use yii\db\Migration;

/**
 * Class m240301_070834_add_table_articles_author
 */
class m240301_070834_add_table_articles_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles_author', [
            'id'            => $this->primaryKey(),
            'first_name'    => $this->string(32)->notNull()->comment('Имя'),
            'middle_name'   => $this->string(32)->null()->comment('Фамилия'),
            'last_name'     => $this->string(32)->null()->comment('Отчество'),
            'birthday_date' => $this->dateTime()->null()->comment('Дата рождения'),
            'biography'     => $this->text()->comment('Биография'),
            'user_id'       => $this->integer()->comment('ID пользователя'),
            'visible'       => $this->tinyInteger()->defaultValue(true)->comment('Флаг видимости'),
            'create_at'     => $this->dateTime()->comment('Дата создания'),
            'update_at'     => $this->dateTime()->comment('Дата последнего изменения'),
        ]);

        $this->addCommentOnTable(
            'articles_author',
            'Таблица авторов статей/новостей'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles_author');
    }

}
