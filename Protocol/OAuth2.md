# OAuth 2.0

認可プロトコル

## 概要

ユーザーに対して、認可サーバ（Twitter、GitHub、etc）へのリソースアクセス認可を要求する仕組み。

## 認証との違い

OAuth2.0は「特定のユーザであることを本人確認」する（認証）ではなく  
「特定のデータへ特定の操作を可能」にする（認可）の仕組み

## 概略

### 登場人物

- 認可サーバ
- アプリケーション
- ユーザ

### 登場データ

- クライアントID（認可サーバがアプリケーションに対して単一のものを発行）
- 認可コード（認可サーバがユーザに対して発行し、ユーザがアプリケーションに渡す）
- アクセストークン（認可サーバがアプリケーションに対してユーザごとに発行）

### アプリケーション側の準備

認可サーバからクライアントIDを発行してもらい、内部に保存しておく。

### ユーザのアプリケーションへ初回アクセスする

認可サーバへのリソースアクセス許可を求める。（認可サーバへのログイン画面に飛ばす）

### ユーザが認可サーバにログインし、アプリケーションとの連携を許可する

ユーザは認可コードを取得するため、それをアプリケーションに渡す。
渡し方はリダイレクトや手入力などアプリケーションによって異なる。

### アプリケーションが認可コードを受け取り、認可サーバにアクセストークンを求める

事前に認可サーバから発行してもらった自身のアプリケーションを示すクライアントIDと、ユーザから受け取った認可コードをペアで認可サーバに対して送り、アクセストークンを入手する。
このアクセストークンを用い、認可サーバ（リソースサーバ）から対象ユーザの情報を取得することが可能になる。

## 参考

- [OAuth2の解説サイトを漁る前に](https://qiita.com/kojisaiki/items/48adf59d5d634fd330af)
- [一番分かりやすい OAuth の説明](https://qiita.com/TakahikoKawasaki/items/e37caf50776e00e733be)
- [OAuth2.0の代表的な利用パターン](https://www.buildinsider.net/enterprise/openid/oauth20)
