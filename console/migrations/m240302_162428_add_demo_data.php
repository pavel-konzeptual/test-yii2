<?php

use yii\db\Migration;

/**
 * Class m240302_162428_add_demo_data
 */
class m240302_162428_add_demo_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $articlesTable         = 'articles';
        $articlesCategoryTable = 'articles_category';
        $categoryArticlesTable = 'category_articles';

        $category1 = ['name' => 'Общие новости', 'description' => 'Все подряд'];
        $category2 = ['name' => 'Прочее', 'description' => 'Не важные новости', 'parent_id' => '1'];

        $this->insert($categoryArticlesTable, $category1);
        $this->insert($categoryArticlesTable, $category2);

        $article1 = [
            'name'        => 'Зоомагазины должны переоборудовать по новым требованиям',
            'alias'       => 'news-1', 
            'announce'    => 'С 1 марта 2024 года к зоомагазинам будут предъявлены новые требования по содержанию животных.',
            'image'       => 'images/articles/1.jpg',
            'description' => '<p>Как рассказал "Российской газете" первый заместитель председателя Комитета Госдумы по экологии, природным ресурсам и охране окружающей среды Владимир Бурматов, крупные сети зоомагазинов уже перестали продавать кошек и собак, так как не могут обеспечить условия.</p><p>"В большинстве магазинов остались канарейки и грызуны. Кошек, собак и морских свинок они убрали. В магазинах говорят, что распродали тех, кто был, новых не берут. Но и удара по их экономике это не наносит", - отметил Бурматов.</p><p>Депутат сообщил, что в среднем только 5% дохода зоомагазины получали благодаря продаже животных, основной доход приносят корма и аксессуары.</p><p>"Раньше магазины не могли создать животным нормальные условия. Там не было ни нормального солнечного света, ни проветривания, ни выгула, ни ветеринарной помощи, они не могли обеспечить нормальный режим дня и социального взаимодействия. Раньше так было можно, сейчас это попадает под закон о жестоком обращении с животным", - добавил он.</p><p>С 1 марта сельхозживотных обязательно нужно будет маркировать. Каждому животному или группе животных присвоят уникальный буквенно-цифровой идентификационный номер и занесут в единую базу данных. Идентифицировать будут коров, свиней, домашнюю птицу, коз и овец, оленей, верблюдов, пчел, выращенных рыб и других. Домашние животные (как и другие не сельскохозяйственные) маркировке подлежать не будут. Маркировка нужна, чтобы предотвратить распространение заразных болезней животных, а также выявлять источники и пути распространения возбудителей. Учет животных Россельхознадзор будет вести бесплатно. А маркировать животных их владельцам придется уже за свой счет.</p>',
            'author_id' => 1,
            'create_user_id' => 1,
        ];

        $article2 = [
            'name'        => 'Ещё раз новость про животных, и зоомагазины', 
            'alias'       => 'staitya-2', 
            'announce'    => 'Каждому животному или группе животных присвоят уникальный буквенно-цифровой идентификационный номер и занесут в единую базу данных',
            'image'       => 'images/articles/2.jpg',
            'description' => '<p>Как рассказал "Российской газете" первый заместитель председателя Комитета Госдумы по экологии, природным ресурсам и охране окружающей среды Владимир Бурматов, крупные сети зоомагазинов уже перестали продавать кошек и собак, так как не могут обеспечить условия.</p><p>"В большинстве магазинов остались канарейки и грызуны. Кошек, собак и морских свинок они убрали. В магазинах говорят, что распродали тех, кто был, новых не берут. Но и удара по их экономике это не наносит", - отметил Бурматов.</p><p>Депутат сообщил, что в среднем только 5% дохода зоомагазины получали благодаря продаже животных, основной доход приносят корма и аксессуары.</p><p>"Раньше магазины не могли создать животным нормальные условия. Там не было ни нормального солнечного света, ни проветривания, ни выгула, ни ветеринарной помощи, они не могли обеспечить нормальный режим дня и социального взаимодействия. Раньше так было можно, сейчас это попадает под закон о жестоком обращении с животным", - добавил он.</p><p>С 1 марта сельхозживотных обязательно нужно будет маркировать. Каждому животному или группе животных присвоят уникальный буквенно-цифровой идентификационный номер и занесут в единую базу данных. Идентифицировать будут коров, свиней, домашнюю птицу, коз и овец, оленей, верблюдов, пчел, выращенных рыб и других. Домашние животные (как и другие не сельскохозяйственные) маркировке подлежать не будут. Маркировка нужна, чтобы предотвратить распространение заразных болезней животных, а также выявлять источники и пути распространения возбудителей. Учет животных Россельхознадзор будет вести бесплатно. А маркировать животных их владельцам придется уже за свой счет.</p>',
            'author_id'   => 1,
            'create_user_id' => 1,
        ];

        $article3 = [
            'name'        => 'Глава Минсельхоза РФ: Россия не заинтересована в зерновой сделке', 
            'alias'       => 'staitya-3', 
            'announce'    => 'Россия не заинтересована в зерновой сделке. У страны есть свои возможности по экспорту зерна, заявил министр сельского хозяйства РФ Дмитрий Патрушев.',
            'image'       => 'images/articles/3.jpg',
            'description' => '<p>Он подчеркнул, что РФ не слишком интересна зерновая сделка, так как возможности нашей страны по экспорту зерна не будут зависеть от нее никаким образом. "Это вопрос в большей степени политический, мы - технический исполнитель", - констатировал Патрушев в эфире Первого канала в преддверии Послания президента РФ Владимира Путина Федеральному Собранию.</p><p>На вопрос о том, были ли исполнены обязательства перед Россией, министр ответил отрицательно. По словам Патрушева, "были лишь попытки, но реально - ничего".</p><p>Ранее пресс-секретарь президента РФ Дмитрий Песков <a href="https://rg.ru/2024/02/08/peskov-zaiavil-chto-net-nikakih-predposylok-dlia-vozobnovleniia-zernovoj-sdelki.html" rel="noopener noreferrer" target="_blank">рассказал</a> СМИ, что в настоящий момент нет никаких предпосылок для возобновления зерновой сделки в том виде, в котором она была обговорена и не выполнена в отношении России.</p>',
            'author_id'   => 1,
            'create_user_id' => 1,
        ];

        $article4 = [
            'name'        => 'Ещё раз новость про зерновую сделку', 
            'alias'       => 'news-4', 
            'announce'    => 'По словам Патрушева, "были лишь попытки, но реально - ничего"',
            'image'       => 'images/articles/4.jpg',
            'description' => '<p>Он подчеркнул, что РФ не слишком интересна зерновая сделка, так как возможности нашей страны по экспорту зерна не будут зависеть от нее никаким образом. "Это вопрос в большей степени политический, мы - технический исполнитель", - констатировал Патрушев в эфире Первого канала в преддверии Послания президента РФ Владимира Путина Федеральному Собранию.</p><p>На вопрос о том, были ли исполнены обязательства перед Россией, министр ответил отрицательно. По словам Патрушева, "были лишь попытки, но реально - ничего".</p><p>Ранее пресс-секретарь президента РФ Дмитрий Песков <a href="https://rg.ru/2024/02/08/peskov-zaiavil-chto-net-nikakih-predposylok-dlia-vozobnovleniia-zernovoj-sdelki.html" rel="noopener noreferrer" target="_blank">рассказал</a> СМИ, что в настоящий момент нет никаких предпосылок для возобновления зерновой сделки в том виде, в котором она была обговорена и не выполнена в отношении России.</p>',
            'author_id'   => 1,
            'create_user_id' => 1,
        ];

        $article5 = [
            'name'        => 'Российские производители пестицидов готовы соперничать с зарубежными в инновациях',
            'alias'       => 'rossiya-pesticidy', 
            'announce'    => 'Технологии производства средств защиты растений все время совершенствуются, а эффективность пестицидов растет. О последних новинках в этой сфере "РГ" рассказал генеральный директор компании "Щелково Агрохим"',
            'image'       => 'images/articles/5.jpg',
            'description' => '<p><strong>Салис Каракотов: </strong>Конечно, например, мы первыми еще в 2005 году стали создавать нанотехнологичные продукты. И за прошедшее время убедились, что выигрываем здесь конкуренцию у иностранцев. Например, семена пшеницы перед посевом протравливают препаратами, которые должны защитить проросток и корневую систему растения от болезней и от насекомых. Весь мир производит эти препараты в виде суспензий, где твердые частицы имеют размер несколько микронов (одна миллионная часть метра). Но размеры пор у зерна пшеницы измеряются нанометрами (одна миллиардная часть метра), и суспензионные продукты просто не попадают внутрь, где и сидит инфекция. Мы создали препараты, где твердые частицы измеряются нанометрами и могут проникать в пористые системы растений.</p><p>Кроме того, у нас есть гербициды с действующими веществами, измеряемыми нанометрами. Эффективность такого гербицида в борьбе с сорняками гораздо выше. Благодаря этому можно использовать меньше препарата, например, не один килограмм на гектар, а полкило. Это уменьшает химическую нагрузку на почву до двух раз и снижает возможные остатки препаратов в продуктах урожая.</p><p><strong>Отечественные препараты еще чем-то отличаются от зарубежных?</strong></p>',
            'author_id'   => 1,
            'create_user_id' => 1,
        ];

        $article6 = [
            'name'        => 'Еще раз новость про пестициды', 
            'alias'       => 'pro-pestiki', 
            'announce'    => ' Эффективность такого гербицида в борьбе с сорняками гораздо выше',
            'image'       => 'images/articles/6.jpg',
            'description' => '<p><strong>Салис Каракотов: </strong>Конечно, например, мы первыми еще в 2005 году стали создавать нанотехнологичные продукты. И за прошедшее время убедились, что выигрываем здесь конкуренцию у иностранцев. Например, семена пшеницы перед посевом протравливают препаратами, которые должны защитить проросток и корневую систему растения от болезней и от насекомых. Весь мир производит эти препараты в виде суспензий, где твердые частицы имеют размер несколько микронов (одна миллионная часть метра). Но размеры пор у зерна пшеницы измеряются нанометрами (одна миллиардная часть метра), и суспензионные продукты просто не попадают внутрь, где и сидит инфекция. Мы создали препараты, где твердые частицы измеряются нанометрами и могут проникать в пористые системы растений.</p><p>Кроме того, у нас есть гербициды с действующими веществами, измеряемыми нанометрами. Эффективность такого гербицида в борьбе с сорняками гораздо выше. Благодаря этому можно использовать меньше препарата, например, не один килограмм на гектар, а полкило. Это уменьшает химическую нагрузку на почву до двух раз и снижает возможные остатки препаратов в продуктах урожая.</p><p><strong>Отечественные препараты еще чем-то отличаются от зарубежных?</strong></p>',
            'author_id'   => 1,
            'create_user_id' => 1,
        ];

        $this->insert($articlesTable, $article1);
        $this->insert($articlesTable, $article2);
        $this->insert($articlesTable, $article3);
        $this->insert($articlesTable, $article4);
        $this->insert($articlesTable, $article5);
        $this->insert($articlesTable, $article6);

        $arCategory1 = ['article_id' => 1, 'category_id' => 1];
        $arCategory2 = ['article_id' => 1, 'category_id' => 2];
        $arCategory3 = ['article_id' => 3, 'category_id' => 1];
        $arCategory4 = ['article_id' => 2, 'category_id' => 2];
        $arCategory5 = ['article_id' => 4, 'category_id' => 1];
        $arCategory6 = ['article_id' => 4, 'category_id' => 2];
        $arCategory7 = ['article_id' => 5, 'category_id' => 2];
        $arCategory8 = ['article_id' => 6, 'category_id' => 1];

        $this->insert($articlesCategoryTable, $arCategory1);
        $this->insert($articlesCategoryTable, $arCategory2);   
        $this->insert($articlesCategoryTable, $arCategory3);   
        $this->insert($articlesCategoryTable, $arCategory4);   
        $this->insert($articlesCategoryTable, $arCategory5);   
        $this->insert($articlesCategoryTable, $arCategory6);   
        $this->insert($articlesCategoryTable, $arCategory7);   
        $this->insert($articlesCategoryTable, $arCategory8);      
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

}
