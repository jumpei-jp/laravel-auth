# Laravel auth
Laravel8の権限の設定

## 開発環境
* laravel: 8.x
* mysql: 8.0.26
* PHP: 8.0-apache-buster

## 手順
### ファイルの修正作業
1. docker/php/Dockerfile のプロジェクト名を修正
2. docker-compose.yamlのcontainer_nameを指定
3. .envファイルの修正

### コマンド操作

    docker-compose build
    docker-compose up

    #コンテナにログイン
    docker exec -it php_auth bash

    #Laravelのインストール（初期操作以外は必要無し）
    composer create-project laravel/laravel auth_test "8.*"

    #このままだとアクセスできないので権限を変更
    chmod 777 -R storage/

## 各サービスログインコマンド

    php
    docker exec -it php_auth bash

    mysql
    docker exec -it mysql_auth mysql -u root -p