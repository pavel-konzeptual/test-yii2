<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\HttpException;
use common\models\ArticlesAuthor;
use common\models\Articles;

/**
 * ArticlesAuthor controller
 */
class ArticlesAuthorController extends Controller
{

    public $modelClass = ArticlesAuthor::class;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function actionView() 
    {
        $author = self::findAuthor();

        return $author;
    }

    public function actionArticles() 
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;

        $author   = self::findAuthor();

        $articles = Articles::find()->andWhere(['author_id' => $author['id']])->active()->limit(10)->all();

        return $this->render('articles', ['articles' => $articles, 'author' => $author]);
    }


    public function findAuthor()
    {
        $authorId   = (int) Yii::$app->request->get('id');

        $model      = (new $this->modelClass())->find()->andWhere(['id' => $authorId])->with('user')->asArray()->one();

        if (empty($model)) {
            throw new HttpException(500, 'Автора не существует');
        }
        
        unset($model['user']['password_hash'], $model['user']['password_reset_token'], $model['user']['auth_key'], $model['user']['verification_token']);

        return $model;
    }
}
