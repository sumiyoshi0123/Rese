# アプリケーション名
Rese（リーズ） 飲食店予約サービス

## 作成した目的 　
自社で予約サービスを持ちたい

## アプリケーションURL

## 機能一覧
 ・会員登録
 
 ・ログイン
 
 ・ログアウト
 
 ・ユーザー情報取得
 
 ・飲食店一覧取得
 
 ・飲食店詳細取得
 
 ・飲食店お気に入り登録・削除
 
 ・飲食店予約情報登録・削除
 
 ・ユーザーお気に入り登録飲食店一覧取得
 
 ・ユーザー予約飲食店情報取得
 
 ・飲食店のエリア検索
 
 ・飲食店のジャンル検索
 
 ・飲食店のキーワード検索　　

## 使用技術
 ・Laravel Framework 8.83.8  
 ・@vue/cli 5.0.8

## テーブル設計
![table](https://github.com/sumiyoshi0123/Rese/assets/138268657/9e36adaf-a3f5-4dc7-86da-7aebe459da22)

## ER図
![ER図](https://github.com/sumiyoshi0123/Rese/assets/138268657/c6a46820-e413-4b0f-b3da-8821bdd5298f)

## 環境構築
1.リポジトリのクローン  
git clone git@github.com:sumiyoshi0123/Rese.git  
cd Rese  
code Rese  

2.Docker の設定  
docker-compose up -d --build

3.Laravelのセットアップ  
docker-compose exec php bash  
composer install  
composer create-project --prefer-dist laravel/laravel Rase  
cp .env.example .env  
  .env’ファイルを編集してデータベース情報を設定  
 php artisan migrate  

4.サーバーの起動  
php artisan serve

5.Vue.jsのセットアップ  
npm install  
npm install vue  
npm install vue-loader  

npm run dev  

6.ブラウザで http://localhost/#/shop にアクセスする




