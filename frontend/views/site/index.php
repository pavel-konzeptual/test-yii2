<?php

/** @var yii\web\View $this */

$this->title = 'Тестовый проект для Порт Транзит';
?>
<div class="site-news>
    <div class="p-3 mb-3 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Новые статьи</h1>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.onload = function() {
        if (window.jQuery) {  
            var limit = 6;
            var sort  = 'name';
            var order = 'id DESC';
            
            getArticles(limit, sort, order);

            setTimeout(function () {
                $('.author_link').each(function(){
                    $(this).click(function(e) {
                        e.preventDefault();

                        var link = $(this);
                        var linkHref = link.attr('href');

                        $.getJSON(linkHref, function(data) {
                            var lastName   = data.last_name ? data.last_name : '';
                            var middleName = data.middle_name ? data.middle_name : '';
                            var userData   = 'Биография: ' + data.biography + ' <br> Дата рождения: ' + data.birthday_date + ' <br>E-Mail: ' + data.user.email;
                            userData      += '<div class="col-md-12"><a href="/articles-author/'+ data.id+'/articles">Все новости автора</a></div>';

                            $('#userModalTitle').html(middleName + ' ' + data.first_name + ' ' + lastName + ' (' + data.user.username + ')');
                            $('#userModalBody').html(userData);
                            $('#userModal').modal('toggle');
                        });
                    })
                });
            }, 1000);
        }
    }

    function getArticles(limit, sort, order) {
        $.getJSON('articles/get-news?limit=' + limit + '&sort=' + sort + '&order=' + order, function(data) {
                $.each(data, function(index, item) {
                    var itemImage = item.image;
                    var newsItem = '<div class="col-md-4 col-xs-12 mb-4"><div class="item_block shadow-sm rounded" style="border: 1px solid #BBB;padding:7px;">';
                    newsItem += '<div class="item_name mb-2"><a href="/articles/'+item.alias+'">'+ item.name +'</a> <?php if (!Yii::$app->user->isGuest): ?><small>(<a href="/articles/update/'+item.id+'">изменить</a>)</small><?php endif; ?></div>';
                    if (itemImage) {
                        newsItem += '<div class="item_image text-center mb-2"><img src="'+item.image+'" class="img-fluid rounded" alt="'+item.name+'"></div>';
                    }
                    newsItem += '<div class="item_announce">'+ item.announce +'</div>';
                    newsItem += '<div class="item_author"><br>Автор: <a href="/articles-author/'+item.author_id+'" class="author_link">'+ item.author.first_name +'</a></div>';
                    newsItem += '</div></div>';

                    $('#mainContent').append(newsItem);
                });
        });
    }
</script>