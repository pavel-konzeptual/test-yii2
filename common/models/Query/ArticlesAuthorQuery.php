<?php

namespace common\models\Query;

use Yii;
use yii\db\ActiveQuery;

class ArticlesAuthorQuery extends ActiveQuery
{
    public function active(): ArticlesQuery
    {
        return $this->andWhere(['visible' => 1]);
    }
}
