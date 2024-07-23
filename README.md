# Atte
勤怠管理アプリです。会員登録をすると毎日の勤怠を記録でき、日付別、個人別の勤怠ログの確認が出来ます。
![Atteホーム画像](https://github.com/user-attachments/assets/f71245d4-de5c-4f01-9da7-8ab24e3d5b62)


## 制作した目的
Laravel学習のまとめとして作成。

## アプリケーションURL
http://ec2-18-183-180-238.ap-northeast-1.compute.amazonaws.com/login

※新規登録時メールによる本人確認あり

## 他のリポジトリ
無し

## 機能一覧
・新規会員登録機能（入力項目：名前、メールアドレス、パスワード、確認用パスワード）※新規登録時メールによる本人確認あり

・ログイン（入力項目：メールアドレス、パスワード）

・ログアウト

・勤怠打刻機能

　　・出勤、退勤の打刻（出勤中に日付をまたいだ場合、またぐ前の退勤ログが「null」に打刻される）
  
　　・休憩開始、終了の打刻（出勤中は何度でも休憩可）
  
・全ユーザーの日付別勤怠記録表示

・ユーザー一覧表示

　　・ユーザー名から個別の勤怠記録表示へ移動

## 使用技術（実行環境）
・Laravel Framework 8.83.27

・PHP7.4.9

・MySQL8.0.26

## テーブル設計
![テーブル設計](https://github.com/user-attachments/assets/4d80bd79-529b-466c-8e78-0a68f8594f84)

## ER図
![table drawio](https://github.com/user-attachments/assets/d1ac35fa-e7b4-4972-ad85-6bafa4efac64)

## 環境構築
Dockerビルド

  1.クローン作成
  
    git clone git@github.com:ishikawashinnya/Atte.git
  
  2.DockerDesktopアプリを立ち上げる

  3.コンテナをビルドして起動
  
    docker-compose up -d --build

Laravel環境構築
  1.docker-compose exec php bash
  
  2.composer install
  
  3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
  
  4..envに以下の環境変数を追加
  
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
    
  5.アプリケーションキーの作成
  
    php artisan key:generate
    
  6.マイグレーションの実行
  
    php artisan migrate

## URL

  ・開発環境：http://localhost/

  ・phpMyAdmin:：http://localhost:8080/
  




