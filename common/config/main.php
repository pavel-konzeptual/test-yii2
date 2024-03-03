<?php
return [
    'id'      => 'port_transit',
    'name'    => 'Порт ТразитT',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache'  => [
            'class' => \yii\caching\FileCache::class,
        ],
       'log' => [
            'targets'  => 
            [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                ],
                'db'   => [
                    'class' => 'yii\log\DbTarget',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => false,
            'showScriptName'      => false,
            'rules'               => 
            [
                // Site
                ''            => 'site/index', 
                'about'       => 'site/about',
                'contact'     => 'site/contact',
                'login'       => 'site/login',
                'logout'      => 'site/logout',
                'signup'      => 'site/signup',

                'articles/get-news'                            => 'articles/get-news',
                'articles/search'                              => 'articles/search',
                'articles/search/page/<page:\d+>'              => 'articles/search',
                'articles/category/<id:\d+>'                   => 'articles/category',
                'articles/category/<id:\d+>/page/<page:\d+>'   => 'articles/category',
                'articles/add'                                 => 'articles/add',
                'articles/create'                              => 'articles/create',
                'articles/<alias:[a-za-z0-9-]+>'               => 'articles/view',
                'articles-author/<id:\d+>'                     => 'articles-author/view',
                'articles-author/<id:\d+>/articles'            => 'articles-author/articles',
                '<controller:[\w-]+>/create'                   => '<controller>/create',
                '<controller:[\w-]+>/update/<id:\d+>'          => '<controller>/update',
                '<controller:[\w-]+>/delete/<id:\d+>'          => '<controller>/delete',
                '<controller:[\w-]+>/get-all'                  => '<controller>/get-all',
                '<controller:[\w-]+>/get-one'                  => '<controller>/get-one',
                '<controller:[\w-]+>/update-status'            => '<controller>/update-status',

                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 
                        [
                            'articles',
                            'articlesAuthor',
                            'articlesCategory',
                            'categoryArticles',
                        ],

                        'pluralize' => false,
                ],
            ],
        ],
    ],
];
