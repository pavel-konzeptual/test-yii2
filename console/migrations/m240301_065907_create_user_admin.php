<?php

use yii\db\Migration;

/**
 * Class m240301_065907_create_user_admin
 */
class m240301_065907_create_user_admin extends Migration
{
    /**
     * Table name
     *
     * @var string
     */
    private $_user = "{{%user}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $passwordHash = Yii::$app->getSecurity()->generatePasswordHash('12345');
        $authKey      = Yii::$app->security->generateRandomString();
        $userTable    = $this->_user;

        $this->insert($userTable, ['username' => 'admin', 'auth_key' => $authKey, 'password_hash' => $passwordHash, 'email' => 'port_db@demo.local', 'status' => 10, 'created_at' => time(), 'updated_at' => time()]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $userTable    = $this->_user;
        $thid->delete($userTable, ['username' => 'admin']);
    }
}
