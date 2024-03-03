#!/usr/bin/env bash

result_msg(){
    if [[ $? != 0 ]]; then
        echo $1' | Код ошибки:'$?
    else
        echo $2
    fi
}
init_docker_network(){
    if [[ -z `docker network ls | grep " $1 "` ]]; then
        docker network create $1 --attachable
        result_msg "- Не удалось добавить сеть $1" "+ Сеть $1 успешно добавлена"
    else
        echo "+ Сеть $1 уже существует"
    fi
}
clone_git(){
    if [[ -z $2 ]];then exit 1; fi;
    if [[ ! -d "$1" ]]; then
        git clone $2 $1
    else
        echo "- $1 уже существует"
    fi
}

# Генерирует ключи шифрования для JWT принимает путь по которому должны лежать файлы ключей
generate_jwt_keys() {
    local key_path='.'
    local private_key_name='oauth_private.key'
    local public_key_name='oauth_public.key'
    if [[ -n $1 ]]; then
        local key_path=${1}
    fi
    if [[ -n $2 ]]; then
        local private_key_name=${2}
    fi
    if [[ -n $3 ]]; then
        local public_key_name=${3}
    fi
    ssh-keygen -t rsa -b 4096 -m PEM -f jwtRS256.key -q -N ""
    # Don't add passphrase
    openssl rsa -in jwtRS256.key -pubout -outform PEM -out jwtRS256.key.pub
    mv -f jwtRS256.key ${key_path}/${private_key_name}
    mv -f jwtRS256.key.pub ${key_path}/${public_key_name}
    chmod 660 ${key_path}/${private_key_name}
    chmod 660 ${key_path}/${public_key_name}
}

# Перезаписываем ключи в нужной директории. По умолчанию в корне проекта
update_jwt_keys() {
    local key_path='.'
    local private_key_name='oauth_private.key'
    local public_key_name='oauth_public.key'
    if [[ -n $1 ]]; then
        local key_path=${1}
    fi
    if [[ -n $2 ]]; then
        local private_key_name=${2}
    fi
    if [[ -n $3 ]]; then
        local public_key_name=${3}
    fi
    if [[ -e ${key_path}/${private_key_name} ]] || [[ -e ${key_path}/${public_key_name} ]];then
        echo -e "\e[33m!!!ВНИМАНИЕ!!!"
        echo "Ключи шифрования уже существуют и будут перезаписаны."
        echo -e "Если их перезаписать, то все выданные ранее токены станут не действительны.\e[0m"
        printf "Перезаписать? (y/n): "
        read answer
        if [[ ${answer} == 'y' ]]; then
            generate_jwt_keys ${key_path}
            echo -e "\e[31m+ Ключи перезаписаны. Все ранее выданные токены не действительны.\e[0m"
        else
            echo "+ Ключи шифрования остались прежними."
        fi
    else
        generate_jwt_keys ${key_path}
    fi
}

add_to_hosts(){
    local host_name=$1
    if [[ `cat /etc/hosts | grep ${host_name}` ]]; then
        echo "+ Сервис уже добавлен в /etc/hosts (${host_name})"
    elif [[ `cat /etc/hosts | grep test-port.ru` ]]; then
        sed -i -e "/test-port.ru/ s/$/ ${host_name}/" /etc/hosts
        echo "+ Сервис добавлен в /etc/hosts (${host_name})"
    else
        sed -i "1i127.0.0.1 ${host_name}" /etc/hosts
        echo "+ Сервис добавлен в /etc/hosts (${host_name})"
    fi
}

echo_header() {
    echo -e "\e[32m${1}\e[0m"
}
