<?php

use yii\db\Migration;

/**
 * Class m240302_113207_add_user_articles_author
 */
class m240302_113207_add_user_articles_author extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('articles_author', 
        [
            'first_name'    => 'Port', 
            'middle_name'   => 'Transit', 
            'biography'     => 'Разработчик проекта Порт Транзит', 
            'birthday_date' => '2015-03-01 16:59:38', 
            'user_id'       => 1, 
            'visible'       => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

}
