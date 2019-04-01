# GoogleCloudPlatform エンタープライズ設計ガイド

## クラウド利用についてと、GCPのメリデメ

最初は概論

### クラウドの3世代

- 第一世代：サーバー、ストレージ、ネットワークリソースを仮想化したプライベートクラウド
- 第二世代：データセンター自体を仮想化したパブリッククラウド
- 第三世代：ITインフラそのものを仮想化したサービス

### 日本企業がパブリッククラウドを利用する際に重視する項目

- 国内リージョン
- 仮想プライベートネットワーク環境
- 自社拠点と仮想プライベートネットワーク環境を接続するセキュアな回線
- 仮想プライベートネットワーク環境内で利用可能なIaaS

### 可用性

> 「Googleサービスを使おうと思って使えなかったことはありますか？」

### GCPのデメリット

日本語のサポートは平日9〜17時に限定されており、これ以外は英語でのサポートになる。  

## コンピューティングサービス

4種類ある。

### Google Compute Engine

GCEとも呼ばれる。  
開発者自身がサーバーに必要なスペックやOSを選定するIaaS（Infrastracture as a Service）


### Google App Engine

GAEとも呼ばれる。  
スケーラブルなWebアプリケーションを構築するためのPaaS（Platform as a Service）

Standard Edition（SE）とFlexible Edition（FE）がある。
まずSEを検討し、機能面で問題があればFEを検討すべき。


以下の魅力的な点を備えている。
- オートスケール
- フルマネージド（NoOps）
- Blue-Greenデプロイ
- Cloud Security Scannerを使うことで、アプリケーションの脆弱性をスキャンし、脅威を検出して攻撃を未然に防ぐことができる。


### Google Kubernetes Engine

GKEとも呼ばれる。  
Dockerコンテナの実行環境が提供される。

プライベートな環境としてGoogle Container RegistryにDockerイメージを保存して使用できる。

### Google Cloud Functions

クラウド場で関数を呼び出した時のみプロセスが起動し、処理が終われば停止する、イベントドリブンのサービス。  
コード実行時間に対してのみ、100ms単位で課金される。

本書執筆時点ではベータ版。

## ストレージサービス

5種類ある。BigQueryはビッグデータサービスとして別枠で扱う。

|サービス |分類 |概要 |用途 |
|-------|-----|----|----|
| Google Cloud Storage(GCS) | BLOB | オブジェクトストレージ | 画像、写真、動画、非構造化データ、バックアップ |
| Google Cloud Bigtable | NoSQL | ワイドカラム型DB | 低レイテンシーアクセス、高スループット解析 |
| Google Cloud Datastore | NoSQL | ドキュメント指向DB | Key-Valueデータ、オートスケーリング |
| Google Cloud SQL | RDB | RDBサービス | 構造化データ、OLTPトランザクション |
| Google Cloud Spanner | RDB | グローバルで水平スケーリング機能を備えたRDBサービス | 高トランザクション（OLTP）、高い拡張性要件、グローバルトランザクション |

### CloudStorage

ファイルの静的配信やバックアップなどが主な用途。
オブジェクトストレージ。

### Bigtable

業界標準となっているApache HBase APIを通じてアクセス可能なフルマネージドNoSQLサービス。  
大規模、低レイテンシー、高スループットが求められる用途で活躍する。

### Datastore

サービス規模に合わせて自動的にスケールされ、処理速度が変化しないことが最大の特徴。  
強整合性と結果整合性の好きな方を選んで更新処理を行える。

### CloudSQL

MySQLとPostgreSQLが選択可能。  
大規模分散アーキテクチャを指向するGoogleはこれまであまり重視していなかったようだが、昨今は拡張が推進されているように見える。

### Spanner

従来のRDBとNoSQLの**いいとこどり**を実現したRDBサービスである。

## ネットワーキングサービス

GCPのネットワーキングサービスには、以下の５種類がある。

### Virtual Private Cloud(VPC)

GCPリソースのために論理的に分離された仮想ネットワーク

### Cloud Load Balancing

グローバルな負荷分散を行うレイヤー4の負荷分散サービス

### Cloud CDN

キャッシュサービス

### Cloud DNS

低レイテンシーで高品質なDNSサービス

### Cloud Interconnect

自社オンプレ環境からセキュアにネットワーク接続するサービス
