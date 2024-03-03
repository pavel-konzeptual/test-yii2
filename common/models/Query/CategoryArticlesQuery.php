<?php

namespace common\models\Query;

use Yii;
use yii\db\ActiveQuery;

class CategoryArticlesQuery extends ActiveQuery
{
    public function active(): CategoryArticlesQuery
    {
        return $this->andWhere(['visible' => 1]);
    }
}
