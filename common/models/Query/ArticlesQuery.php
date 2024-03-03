<?php

namespace common\models\Query;

use Yii;
use yii\db\ActiveQuery;

class ArticlesQuery extends ActiveQuery
{
    public function getLatest(int $limit = null): ArticlesQuery
    {
        if (!$limit) {
            $limit = 5;
        }

        return $this->active()->limit($limit)->orderBy('id DESC');
    }

    public function active(): ArticlesQuery
    {
        return $this->andWhere(['visible' => 1]);
    }
}
