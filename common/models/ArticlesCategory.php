<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use common\models\Query\ArticlesCategoryQuery;
use common\models\CategoryArticles;
use common\models\Query\CategoryArticlesQuery;

/**
 * This is the model class for table "articles_category".
 *
 * @property int      $id
 * @property int      $article_id
 * @property int      $category_id
 * @property date     $create_at
 * @property date     $update_at
 */
class ArticlesCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles_category%}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'article_id'    => 'ID статьи',
            'category_id'   => 'ID категории',
            'create_at'     => 'Дата создания',
            'update_at'     => 'Дата последнего изменения',
        ];
    }

    public static function find(): ArticlesCategoryQuery
    {
        return new ArticlesCategoryQuery(get_called_class());
    }

    public function getArticle(): CategoryArticlesQuery
    {
        return $this->hasOne(Articles::className(), ['id' => 'article_id'])->active();
    }

    public function getCategoryData(): CategoryArticlesQuery
    {
        return $this->hasOne(CategoryArticles::className(), ['id' => 'category_id'])->active();
    }

}