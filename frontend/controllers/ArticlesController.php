<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\HttpException;
use yii\web\UploadedFile as File;
use common\models\Articles;
use yii\data\Pagination;

/**
 * Articles controller
 */
class ArticlesController extends Controller
{

    public $modelClass = Articles::class;

    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function actionIndex() 
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;

        $query = Articles::find()->active()->with('author');

        $pages = new Pagination([
            'totalCount'     => $query->count(),
            'pageSize'       => 3,
            'forcePageParam' => false,
            'pageSizeParam'  => false
        ]);

        $articles = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->orderBy('id DESC')
            ->all();
        
        return $this->render('index', ['articles' => $articles, 'pages' => $pages]);
    }

    public function actionAdd()
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;
        
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Войдите под своим логином, чтобы добавить новость.');

            return $this->goHome();
        }

        $model = (new $this->modelClass());

        return $this->render('add', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = (new $this->modelClass());

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $articlesFile          = File::getInstance($model, 'image');

            if (!empty($articlesFile)) {
                $pathFile              = 'images/articles/' . rand() . '.' . $articlesFile->extension;
                $model->image          = $pathFile;
            }

            $model->create_user_id = Yii::$app->user->identity->id;
            $model->author_id      = Yii::$app->user->identity->id;
           

            if ($model->save()) {
                if (!empty($articlesFile)) {
                    $articlesFile->saveAs($pathFile);
                }
            }            

            Yii::$app->session->setFlash('success', 'Новость успешно добавлена');

            return 'ok';
        }

        throw new HttpException(500, 'Ошибка добавления: ' . implode("\n", $model->firstErrors));
    }

    public function actionUpdate()
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Войдите под своим логином, чтобы изменить новость.');

            return $this->goHome();
        }

        $articlesId = (int) Yii::$app->request->get('id');
        $model      = (new $this->modelClass())->find()->andWhere(['id' => $articlesId])->active()->one();
        $oldImage   = $model->image;

        if (empty($model)) {
            Yii::$app->session->setFlash('error', 'Такой новости не существует');

            return $this->goHome();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $articlesFile          = File::getInstance($model, 'image');

            if (!empty($articlesFile)) {
                $pathFile              = 'images/articles/' . rand() . '.' . $articlesFile->extension;
                $model->image          = $pathFile;
            } else {
                $model->image          = $oldImage;
            }

            if ($model->save()) {
                if (!empty($articlesFile)) {
                    $articlesFile->saveAs($pathFile);
                }
            }   

            Yii::$app->session->setFlash('success', 'Новость успешно обновлена');

            return 'ok';
        }
    
        if ($model->firstErrors) {
            throw new HttpException(500, 'Ошибка обновления: ' . implode("\n", $model->firstErrors));
        }

        return $this->render('add', ['model' => $model]);

    }

    public function actionGetNews() 
    {
        $limit = (int) Yii::$app->request->getQueryParam('limit');
        $sort  = (string) Yii::$app->request->getQueryParam('sort');
        $order = (string) Yii::$app->request->getQueryParam('order');

        return (new Articles())->find()->getLatest($limit)->with(['author', 'category'])->asArray()->all();
    }

    public function actionView() 
    {
        \Yii::$app->response->format = Response::FORMAT_HTML;

        $artAlias   = (string) Yii::$app->request->get('alias');

        $model      = (new $this->modelClass())->find()->active()->andWhere(['alias' => $artAlias])->with('author')->one();

        if (empty($model)) {
            Yii::$app->session->setFlash('error', 'Такой новости не существует');

            return $this->goHome();
        }

        return $this->render('view', ['model' => $model]);
    }

    public function actionSearch($query = '', $page = 1) {

        $page = (int) $page;

        list($articles, $pages) = (new $this->modelClass())->getSearchResult($query, $page);

        return compact('articles', 'pages');
       
    }
  
}
