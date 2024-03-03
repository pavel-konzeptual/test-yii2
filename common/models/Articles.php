<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use common\models\ArticlesAuthor as Author;
use common\models\Query\ArticlesQuery;
use common\models\ArticlesCategory as Category;
use common\models\Query\ArticlesCategoryQuery;
use common\services\SearchService;

/**
 * This is the model class for table "articles".
 *
 * @property int      $id
 * @property string   $name
 * @property string   $alias
 * @property string   $image
 * @property string   $announce
 * @property string   $description
 * @property int      $author_id
 * @property int      $create_user_id
 * @property int      $update_user_id
 * @property int      $visible
 * @property date     $create_at
 * @property date     $update_at
 *
 * @property Author   $author
 * @property Category $category
 */
class Articles extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%articles%}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'announce', 'alias'], 'required'],
            [['name', 'alias', 'announce'], 'string', 'max' => 255],
            [['alias'], 'string', 'max'  => 48],
            ['alias', 'match', 'pattern' => '/^[a-z0-9-]+$/', 'message' => 'Можно использовать только латинский алфавит в строчном формате, цифры, тире.'],
            ['alias', 'filter', 'filter' => 'strtolower'],
            [['description'], 'string'],
            [['author_id', 'create_user_id', 'update_user_id', 'visible'], 'integer'],
            [['alias'], 'unique', 'message'  => 'Алиас статьи должен быть уникальным.'],
            [['name'], 'unique', 'message'   => 'Название статьи должно быть уникальным.'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, png, gif, jpeg', 'checkExtensionByMimeType' => false,],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Название',
            'alias'       => 'Алиас',
            'image'       => 'Изображение',
            'announce'    => 'Анонс',
            'description' => 'Текст новости',
            'author_id'   => 'ID автора',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => (new \DateTime())->format('Y-m-d H:i:s'),
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->update_user_id = Yii::$app->user->identity->id;

            return parent::beforeSave($insert);
        }
    }

    public static function find(): ArticlesQuery
    {
        return new ArticlesQuery(get_called_class());
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    public function getCategory(): ArticlesCategoryQuery
    {
        return $this->hasMany(ArticlesCategory::className(), ['article_id' => 'id'])->with('categoryData');
    }

    public function getSearchResult($search, $page): array 
    {
        return SearchService::searchByLikeArticles($search, $page);
    }

}
