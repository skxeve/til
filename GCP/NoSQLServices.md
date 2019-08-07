# NoSQLサービスについて

NoSQLサービスでできること、複数サービスの性質の比較などの調査メモ。

対象サービスは以下

- Datastore
- Firestore
- Bigtable

## 比較表

| | Datastore | Firestore | Bigtable | 参考 |
| --- | --- | --- | --- | --- |
| 標語 | NoSQL ドキュメントデータベースサービス | モバイルアプリやウェブアプリのデータをグローバル規模で保存します | NoSQL ワイドカラムデータベースサービス | [GCP プロダクトとサービス](https://cloud.google.com/products/?hl_ja#databases) |
| セールストーク | アプリケーション向け、スケーラビリティが高いNoSQLデータベース。シームレスかつ自動的にスケール。複数のプロパティを横断してデータを検索し、必要に応じて並び替えることができる高度なクエリエンジンを提供。 | Cloud FirestoreはCloud Datastoreの次世代版です。<br> | 10ms以下の一貫したレイテンシ。アドテック、フィンテック、IoTに最適。機械学習アプリケーション用のストレージエンジン。 | |
| Always Free | 1GB Storage<br>Entity Reads 50,000<br>Entity Writes 20,000<br>Entity Deletes 20,000<br>小規模オペレーション50,000(超えても無料) | 同左 | なし | [Datastore](https://cloud.google.com/datastore/?hl=ja)<br>[Firestore Pricing](https://cloud.google.com/firestore/pricing?hl=ja) |
| 料金（東京） | Storage $0.115/GB/Month<br>Entity Reads $0.038/10万Entities<br>Entity Writes $0.115/10万Entities<br>Entity Deletes $0.013/10万Entities | 同左（単位がEntityからDocumentに） | Nodes $0.85 node/hr<br>SSD $0.22/GB/Month<br>HDD $0.034/GB/Month<br>Network(上り) Free<br>Network(下り) リージョン間のインターネット下り料金を適用 | [Bigtable](https://cloud.google.com/bigtable/?hl=ja) |