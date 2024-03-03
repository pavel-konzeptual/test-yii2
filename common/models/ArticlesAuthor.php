<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use common\models\Query\ArticlesAuthorQuery;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "articles_author".
 *
 * @property int      $id
 * @property string   $first_name
 * @property string   $middle_name
 * @property string   $last_name
 * @property string   $birthday_date
 * @property string   $biography
 * @property int      $user_id
 * @property int      $visible
 * @property date     $create_at
 * @property date     $update_at
 * 
 * @property User     $user
 */
class ArticlesAuthor extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles_author%}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'first_name'    => 'Имя',
            'middle_name'   => 'Фамилия',
            'last_name'     => 'Отчество',
            'birthday_date' => 'Дата рождения',
            'biography'     => 'Биография',
            'user_id'       => 'ID пользователя',
            'visible'       => 'Флаг видимости',
            'create_at'     => 'Дата создания',
            'update_at'     => 'Дата последнего изменения',
        ];
    }

    public static function find(): ArticlesAuthorQuery
    {
        return new ArticlesAuthorQuery(get_called_class());
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}