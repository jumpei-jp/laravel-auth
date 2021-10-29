# Laravel auth
Laravel8の権限の設定

## 開発環境
* laravel: 8.x
* mysql: 8.0.26
* PHP: 8.0-apache-buster

## 初期環境構築手順
### ファイルの修正作業
1. 以下.envファイルの修正

> laravel-auth/.env  
laravel-auth/html/auth_test/.env

### コマンド操作

    docker-compose build
    docker-compose up

    #コンテナにログイン
    docker exec -it php_auth bash

    #composerのインストール
    composer install

    #keyの作成
    php artisan key:generate

    #もし権限が無くてアクセスができない場合には以下コマンド
    chmod 777 -R storage/

以下にログインしてwelcomeページが表示されるとOK
>http://localhost/

## 各サービスログインコマンド

    php
    docker exec -it php_auth bash

    mysql
    docker exec -it mysql_auth mysql -u root -p