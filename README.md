<h1>Port Transit Test</h1>
<p>Приложение на Yii2. Сделал за субботу, сколько получилось)</p>

<p><img src="https://i.ibb.co/4pGhkjm/port-trans.png"></p>

<p>Не стал использовать Dto и репозитории, так как не вижу смысла усложнять простое приложение.</p>

<p><b>Для запуска клонировать репозиторий (ветка master).</b></p>

<p><b>Зайти в папку в консоли:</b></p>
<p>cd /repositoryFolder/</p>

<p><b>Запустить скрипт командой:</b></p>
<p>sh init_docker.sh</p>

<p>Если в /etc/hosts не добавился домен, то добавить:</p>
<p>127.0.0.1  test-port.ru</p>

<p><b>Открыть в браузере:</b></p>
<p>test-port.ru:85</p>

<p>Скрипт тестировался под linux (manjaro).</p>

<p><b>Если сайт пуст</b>, значит не запустили миграции, в консоли запусть команду:</p>
<p>docker exec -i test_port_app_1 bash -c "cd /var/www/app && php yii migrate"</p>