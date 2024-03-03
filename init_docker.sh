#!/usr/bin/env bash
source ./scripts/functions.sh

echo_header '\r\n##Добавляем записи в /etc/hosts##'
add_to_hosts "test-port.ru"

echo_header '\r\n#### Запускаем докер ####'
docker pull mariadb
docker pull php
docker-compose -f docker-compose.port.yml -p test_port up -d
docker exec -i test_port_app_1 bash -c "cd /var/www/app && php yii migrate"