<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Query\CategoryArticlesQuery;

/**
 * This is the model class for table "category_articles".
 *
 * @property int      $id
 * @property int      $parent_id
 * @property string   $name
 * @property string   $description
 * @property string   $meta_name
 * @property string   $meta_description
 * @property string   $keywords
 * @property int      $visible
 * @property date     $create_at
 * @property date     $update_at
 */
class CategoryArticles extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_articles%}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'               => 'ID',
            'parent_id'        => 'ID привязанной категории',
            'name'             => 'Название',
            'description'      => 'Описание',
            'meta_name'        => 'Мета название',
            'meta_description' => 'Мета описание',
            'keywords'         => 'Ключевые слова (мета, теги)',
            'visible'          => 'Флаг видимости',
            'create_at'        => 'Дата создания',
            'update_at'        => 'Дата последнего изменения',
        ];
    }

    public static function find(): CategoryArticlesQuery
    {
        return new CategoryArticlesQuery(get_called_class());
    }
}