<?php

namespace common\services;

use Yii;
use yii\data\Pagination;
use common\models\Articles;

class SearchService
{

    public static function searchByLikeArticles($search, $page): array 
     {
        $search = self::cleanSearchQuery($search);

        if (empty($search)) {
            return [null, null];
        }

        $key = 'search-' . md5($search) . '-page-'.$page;
        $data = Yii::$app->cache->get($key);

        if ($data === false) {
            $query = Articles::find()->where(['like', 'name', $search])->active()->with('author');

            $pages = new Pagination([
                'totalCount'     => $query->count(),
                'pageSize'       => 10,
                'forcePageParam' => false,
                'pageSizeParam'  => false
            ]);

            $articles = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();


            $data = [$articles, $pages];
            Yii::$app->cache->set($key, $data);
        }

        return $data;
    }

    protected static function cleanSearchQuery($query): string
    {
        $searchString = iconv_substr($query, 0, 64);
        $searchString = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $searchString);
        $searchString = preg_replace('#\s+#u', ' ', $searchString);
        $searchString = trim($searchString);

        return $searchString;
    }
}